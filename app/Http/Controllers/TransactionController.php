<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Transaction::where('customer_id', $user->id)
            ->with(['jobPost', 'mitra.user'])
            ->orderBy('created_at', 'desc');

        // Apply status filter
        $status = $request->query('status', 'all');
        if ($status !== 'all') {
            $query->where('payment_status', $status);
        }

        // Apply search
        if ($request->has('search') && !empty($request->query('search'))) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('jobPost', function ($q) use ($search) {
                      $q->where('title', 'like', "%{$search}%");
                  })
                  ->orWhereHas('mitra.user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Statistics for dashboard cards
        $stats = [
            'total' => Transaction::where('customer_id', $user->id)->count(),
            'completed' => Transaction::where('customer_id', $user->id)->where('payment_status', 'paid')->count(),
            'pending' => Transaction::where('customer_id', $user->id)->where('payment_status', 'pending')->count(),
            'failed' => Transaction::where('customer_id', $user->id)->where('payment_status', 'failed')->count(),
        ];

        // Paginate results
        $perPage = $request->query('per_page', 10);
        $transactions = $query->paginate($perPage);

        // Format transactions for frontend
        $formattedTransactions = $transactions->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'invoice_number' => $transaction->invoice_number,
                'job_title' => $transaction->jobPost->title ?? 'N/A',
                'mitra_name' => $transaction->mitra->user->name ?? 'N/A',
                'amount' => $transaction->amount,
                'admin_fee' => $transaction->admin_fee,
                'mitra_earning' => $transaction->mitra_earning,
                'payment_status' => $transaction->payment_status,
                'payment_method' => $transaction->payment_method,
                'payment_date' => $transaction->payment_date ? $transaction->payment_date->toDateTimeString() : null,
                'transaction_reference' => $transaction->transaction_reference,
                'created_at' => $transaction->created_at->toDateTimeString(),
            ];
        });

        // Handle AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'transactions' => $formattedTransactions,
                'stats' => $stats,
                'pagination' => [
                    'current_page' => $transactions->currentPage(),
                    'last_page' => $transactions->lastPage(),
                    'total' => $transactions->total(),
                    'per_page' => $transactions->perPage(),
                ]
            ]);
        }

        return view('customer.order_history', [
            'transactions' => $formattedTransactions,
            'pagination' => [
                'current_page' => $transactions->currentPage(),
                'last_page' => $transactions->lastPage(),
                'total' => $transactions->total(),
                'per_page' => $transactions->perPage(),
            ],
            'stats' => $stats,
        ]);
    }

    public function show($id)
    {
        try {
            $transaction = Transaction::where('customer_id', Auth::user()->id)
                ->with(['jobPost', 'mitra.user'])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $transaction->id,
                    'invoice_number' => $transaction->invoice_number,
                    'job_title' => $transaction->jobPost->title ?? 'N/A',
                    'mitra_name' => $transaction->mitra->user->name ?? 'N/A',
                    'amount' => $transaction->amount,
                    'admin_fee' => $transaction->admin_fee,
                    'mitra_earning' => $transaction->mitra_earning,
                    'payment_status' => $transaction->payment_status,
                    'payment_method' => $transaction->payment_method,
                    'payment_date' => $transaction->payment_date ? $transaction->payment_date->toDateTimeString() : null,
                    'transaction_reference' => $transaction->transaction_reference,
                    'created_at' => $transaction->created_at->toDateTimeString(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }
    }

    public function export(Request $request)
    {
        $user = Auth::user();
        $status = $request->query('status', 'all');
        $search = $request->query('search');

        return Excel::download(
            new TransactionsExport($user->id, $status, $search),
            'order_history_' . date('Y-m-d') . '.csv'
        );
    }
}