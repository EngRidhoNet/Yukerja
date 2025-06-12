<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobApplicationController extends Controller
{
    public function index()
    {
        // Get the authenticated user's customer ID
        $customerId = Auth::user()->customer->id;
        
        $jobPosts = JobPost::where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($jobPosts);
        
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
                ->with('mitra.mitra') // Tetap gunakan eager loading bersarang
                ->get()
                // --- PERBAIKAN UTAMA DI DALAM MAP ---
                ->map(function ($app) {
                    
                    // Ambil relasi user (mitra) dan profil mitra untuk mempermudah pembacaan
                    $mitraUser = $app->mitra;
                    // Gunakan optional() untuk mengambil profil mitra, ini aman jika $mitraUser itu null
                    $mitraProfile = optional($mitraUser)->mitra;
    
                    return [
                        'id' => $app->id,
                        'status' => $app->status,
                        'bid_amount' => $app->bid_amount,
                        'message' => $app->message,
                        'estimated_completion_time' => $app->estimated_completion_time,
                        'mitra' => [
                            // Gunakan optional() + null coalescing operator (??) untuk fallback
                            'id' => optional($mitraUser)->id ?? null,
                            'name' => optional($mitraUser)->name ?? 'Mitra Tidak Ditemukan',
                            'profile_photo_url' => optional($mitraUser)->profile_photo_url ?? null,
    
                            // Ini adalah bagian kunci: akses properti dari $mitraProfile yang mungkin null
                            'job_title' => optional($mitraProfile)->job_title ?? 'Informasi Tidak Tersedia',
                            'reviews_count' => optional($mitraProfile)->reviews_count ?? 0,
                            'rating' => optional($mitraProfile)->rating ?? 0,
                        ],
                    ];
                }); // Kita tidak lagi memerlukan ->filter() atau ->values() karena tidak ada yang dihapus
    
            return response()->json([
                'jobPost' => ['title' => $jobPost->title],
                'applications' => $applications, // Sekarang seharusnya tidak kosong
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
        $this->authorizeApplication($application);
        
        $application->update(['status' => 'accepted']);
        $application->jobPost->update(['status' => 'in_progress']);

        return redirect()->route('customer.dashboard.penawaran')
            ->with('success', 'Application accepted successfully!');
    }

    public function reject(JobApplication $application)
    {
        $this->authorizeApplication($application);
        
        $application->update(['status' => 'rejected']);

        return redirect()->route('customer.dashboard.penawaran')
            ->with('success', 'Application rejected successfully!');
    }

    public function rate(Request $request, JobApplication $application)
    {
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

        return redirect()->route('customer.dashboard.penawaran')
            ->with('success', 'Rating submitted successfully!');
    }

    private function authorizeApplication(JobApplication $application)
    {
        if ($application->jobPost->customer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}