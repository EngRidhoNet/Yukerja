<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $mitraId = Auth::guard('mitra')->user()->id;
        $transaction = Transaction::where('mitra_id', $mitraId)
            ->with(['jobPost', 'customer'])
            ->findOrFail($id);
        $notifications = \App\Models\Notification::where('user_id', Auth::guard('mitra')->user()->id)->latest()->get(); // Fetch notifications

        return view('mitra.show', compact('transaction', 'notifications'));
    }
}