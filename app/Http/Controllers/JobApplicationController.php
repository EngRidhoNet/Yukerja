<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\Transaction; // TAMBAHKAN IMPORT INI
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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


    public function markAsCompleted(JobApplication $application)
    {
        try {
            $this->authorizeApplication($application);

            if ($application->status !== 'in_progress') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya pekerjaan yang sedang berlangsung yang bisa ditandai selesai.'
                ], 400);
            }

            DB::beginTransaction();

            $application->update(['status' => 'completed']);
            $application->jobPost->update(['status' => 'completed']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pekerjaan berhasil ditandai selesai!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error marking as completed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function accept(JobApplication $application)
    {
        try {
            $this->authorizeApplication($application);

            DB::beginTransaction();

            // Update application status
            $application->update(['status' => 'accepted']);

            // Reject other applications for this job
            JobApplication::where('job_post_id', $application->job_post_id)
                ->where('id', '!=', $application->id)
                ->where('status', 'open')
                ->update(['status' => 'rejected']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Penawaran berhasil diterima! Silakan lakukan pembayaran untuk memulai pekerjaan.'
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

    public function reject(JobApplication $application)
    {
        try {
            $this->authorizeApplication($application);

            $application->update(['status' => 'rejected']);

            return response()->json([
                'success' => true,
                'message' => 'Penawaran berhasil ditolak!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error rejecting application: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menolak penawaran: ' . $e->getMessage()
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

    public function rate(Request $request, JobApplication $application)
    {
        try {
            $this->authorizeApplication($application);

            $validated = $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'review' => 'nullable|string|max:1000',
            ]);

            $application->update([
                'status' => 'completed',
                'rating' => $validated['rating'],
                'review' => $validated['review'],
            ]);

            $application->jobPost->update(['status' => 'completed']);

            return response()->json([
                'success' => true,
                'message' => 'Rating berhasil diberikan!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error rating application: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memberikan rating: ' . $e->getMessage()
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

    public function delete(JobApplication $application)
    {
        try {
            $this->authorizeApplication($application);

            $application->delete();

            return response()->json([
                'success' => true,
                'message' => 'Penawaran berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting application: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus penawaran: ' . $e->getMessage()
            ], 500);
        }
    }
}
