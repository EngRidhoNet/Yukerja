<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Revenue;
use App\Models\Setting;
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
                'commission_rate' => $transaction->commission_rate, // this is where we changed it
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
                    'commission_rate' => $transaction->commission_rate,
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

    public function store(Request $request)
    {
        // Validasi input data transaksi
        $request->validate([
            'job_post_id' => 'required|exists:job_posts,id',
            'customer_id' => 'required|exists:customers,id',
            'mitra_id' => 'required|exists:mitras,id',
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|string',
            'payment_method' => 'nullable|string',
            'invoice_number' => 'required|string',
            'payment_date' => 'nullable|date',
            'transaction_reference' => 'nullable|string',
        ]);

        // Simpan transaksi baru
        $transaction = Transaction::create([
            'job_post_id' => $request->job_post_id,
            'customer_id' => $request->customer_id,
            'mitra_id' => $request->mitra_id,
            'amount' => $request->amount,
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
            'invoice_number' => $request->invoice_number,
            'payment_date' => $request->payment_date,
            'transaction_reference' => $request->transaction_reference,
        ]);

        // Ambil nilai komisi dari settings
        $commission_rate = Setting::where('key', 'commission_rate')->first()->value;

        // Hitung platform_share dan mitra_share
        $platform_share = $transaction->amount * ($commission_rate / 100);
        $mitra_share = $transaction->amount - $platform_share;

        // Simpan data revenue ke tabel revenues
        Revenue::create([
            'transaction_id' => $transaction->id,
            'amount' => $transaction->amount,
            'commission_rate' => $commission_rate,
            'platform_share' => $platform_share,
            'mitra_share' => $mitra_share,
        ]);

        // Kembalikan response sukses
        return response()->json(['message' => 'Transaction and revenue recorded successfully']);
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
