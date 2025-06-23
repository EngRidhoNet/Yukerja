<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobPost;
use App\Models\JobApplication;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\Revenue;  // Import Revenue model
use Illuminate\Support\Facades\DB;

class MitraTransactionController extends Controller
{
    public function index(Request $request)
    {
        // Get authenticated mitra/user
        $mitra = Auth::user();
        
        // Base query with relationships
        $query = Transaction::with(['jobPost', 'customer'])
                    ->where('mitra_id', $mitra->id);
    
        // Apply status filter if provided
        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }
    
        // Apply search filter if provided
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('invoice_number', 'like', $searchTerm)
                  ->orWhereHas('jobPost', function ($q) use ($searchTerm) {
                      $q->where('title', 'like', $searchTerm);
                  })
                  ->orWhereHas('customer', function ($q) use ($searchTerm) {
                      $q->where('name', 'like', $searchTerm);
                  });
            });
        }
    
        // Apply sorting
        $sort = $request->input('sort', 'payment_date');
        $direction = $request->input('direction', 'desc');
        $validSorts = ['payment_date', 'amount', 'created_at']; // Add other sortable fields
        
        if (in_array($sort, $validSorts)) {
            $query->orderBy($sort, $direction);
        }
    
        // Paginate results
        $transactions = $query->paginate(10)
            ->appends($request->query());
    
        // Get notifications
        $notifications = Notification::where('user_id', $mitra->id)
                            ->latest()
                            ->get();
    
        return view('mitra.transaksi', [
            'transactions' => $transactions,
            'notifications' => $notifications,
            'user' => $mitra,
            'mitra' => $mitra
        ]);
    }

    public function show($id)
    {
        try {
            // Fetch the transaction and the related revenue record for mitra_share
            $transaction = Transaction::with(['jobPost', 'customer'])
                ->where('mitra_id', auth()->user()->mitra->id)
                ->findOrFail($id);

            // Fetch revenue record for mitra_share
            $revenue = Revenue::where('transaction_id', $transaction->id)->first();
            $mitra_share = $revenue ? number_format($revenue->mitra_share, 0, ',', '.') : 0;

            // Return the response with mitra_share from revenues
            return response()->json([
                'invoice_number' => $transaction->invoice_number,
                'job_title' => $transaction->jobPost->title,
                'customer_name' => $transaction->customer->name,
                'amount' => number_format($transaction->amount, 0, ',', '.'),
                'commission_rate' => number_format($transaction->commission_rate, 0, ',', '.'),  // Now using commission_rate for admin_fee
                'mitra_share' => $mitra_share,  // Menyimpan mitra_share
                'payment_status' => $transaction->payment_status,
                'payment_method' => $transaction->payment_method,
                'payment_date' => \Carbon\Carbon::parse($transaction->payment_date)->translatedFormat('l, d M Y • H:i'),
                'transaction_reference' => $transaction->transaction_reference
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }
    }
}
