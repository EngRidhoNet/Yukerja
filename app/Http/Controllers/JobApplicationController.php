<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\Transaction;
use App\Models\Revenue;  // Import Revenue model
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;  // Pastikan ini yang diimpor

class JobApplicationController extends Controller
{
    public function index()
    {
        // Get the authenticated user's customer ID
        $customerId = Auth::user()->customer->id;
        
        $jobPosts = JobPost::where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.penawaran', compact('jobPosts'));
    }

    public function getApplications(Request $request, $jobPostId)
    {
        try {
            $customer = Auth::user()->customer;
    
            if (!$customer) {
                return response()->json(['error' => 'Akses ditolak. Profil pelanggan tidak ditemukan.'], 403);
            }
    
            $jobPost = JobPost::where('customer_id', $customer->id)->findOrFail($jobPostId);
    
            $applications = JobApplication::where('job_post_id', $jobPostId)
                ->with('mitra.mitra')
                ->get()
                ->map(function ($app) {
                    
                    $mitraUser = $app->mitra;
                    $mitraProfile = optional($mitraUser)->mitra;
    
                    // Ambil mitra_share dari tabel revenues
                    $revenue = Revenue::where('transaction_id', $app->transaction_id)->first();
                    $mitra_share = $revenue ? number_format($revenue->mitra_share, 0, ',', '.') : 0;
    
                    return [
                        'id' => $app->id,
                        'status' => $app->status ?? 'open', // Default ke 'open' jika null
                        'bid_amount' => $app->bid_amount,
                        'message' => $app->message,
                        'estimated_completion_time' => $app->estimated_completion_time,
                        'mitra' => [
                            'id' => optional($mitraUser)->id ?? null,
                            'name' => optional($mitraUser)->name ?? 'Mitra Tidak Ditemukan',
                            'profile_photo_url' => optional($mitraUser)->profile_photo_url ?? null,
                            'job_title' => optional($mitraProfile)->job_title ?? 'Informasi Tidak Tersedia',
                            'reviews_count' => optional($mitraProfile)->reviews_count ?? 0,
                            'rating' => optional($mitraProfile)->rating ?? 0,
                            'mitra_share' => $mitra_share, // Menampilkan mitra_share
                        ],
                    ];
                });
    
            return response()->json([
                'jobPost' => ['title' => $jobPost->title],
                'applications' => $applications,
            ]);
    
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Pekerjaan tidak ditemukan atau Anda tidak memiliki akses.'], 404);
        } catch (\Exception $e) {
            Log::error('Error in getApplications: ' . $e->getMessage() . ' on line ' . $e->getLine() . ' in ' . $e->getFile());
            return response()->json(['error' => 'Terjadi kesalahan pada server.'], 500);
        }
    }

    public function accept(JobApplication $application)
    {
        try {
            $this->authorizeApplication($application);
            
            DB::beginTransaction();
            
            // Update application status
            $application->update(['status' => 'accepted']);
            $application->jobPost->update(['status' => 'in_progress']);
            
            // Create transaction
            $commission_rate = Setting::where('key', 'commission_rate')->first()->value; // Mendapatkan commission_rate dari setting
            $amount = $application->bid_amount;
            $platform_share = $amount * ($commission_rate / 100);
            $mitra_share = $amount - $platform_share;
            
            // Simpan ke tabel transaksi
            $transaction = Transaction::create([
                'job_post_id' => $application->job_post_id,
                'customer_id' => $application->jobPost->customer_id,
                'mitra_id' => $application->mitra_id,
                'amount' => $amount,
                'commission_rate' => $platform_share, // Menggunakan commission_rate, bukan admin_fee
                'mitra_share' => $mitra_share,  // Menyimpan mitra_share
                'payment_status' => 'pending',
                'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad($application->id, 6, '0', STR_PAD_LEFT),
            ]);
            
            // Simpan data revenue ke tabel revenues
            Revenue::create([
                'transaction_id' => $transaction->id,
                'amount' => $transaction->amount,
                'commission_rate' => $commission_rate,
                'platform_share' => $platform_share,
                'mitra_share' => $mitra_share
            ]);
            
            // Reject other applications for this job
            JobApplication::where('job_post_id', $application->job_post_id)
                ->where('id', '!=', $application->id)
                ->where('status', 'open')
                ->update(['status' => 'rejected']);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Penawaran berhasil diterima dan transaksi telah dibuat!'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error accepting application: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menerima penawaran: ' . $e->getMessage()
            ], 500);
        }
    }
    public function deal(JobApplication $application)
    {
        try {
            $this->authorizeApplication($application);
            
            if ($application->status !== 'accepted') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya penawaran yang telah diterima yang bisa di-deal.'
                ], 400);
            }
            
            DB::beginTransaction();
            
            // Update application to in_progress
            $application->update(['status' => 'in_progress']);
            
            // Update transaction payment status
            $transaction = Transaction::where('job_post_id', $application->job_post_id)
                ->where('mitra_id', $application->mitra_id)
                ->first();
                
            if ($transaction) {
                $transaction->update([
                    'payment_status' => 'paid',
                    'payment_date' => now(),
                    'payment_method' => 'deal'
                ]);
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Deal berhasil! Pekerjaan dimulai.'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error processing deal: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses deal: ' . $e->getMessage()
            ], 500);
        }
    }


    private function authorizeApplication(JobApplication $application)
    {
        $customer = Auth::user()->customer;
        if (!$customer || $application->jobPost->customer_id !== $customer->id) {
            throw new \Exception('Unauthorized action.');
        }
    }
}

