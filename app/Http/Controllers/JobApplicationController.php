<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $jobPost = JobPost::where('customer_id', Auth::id())->findOrFail($jobPostId);
        $applications = JobApplication::where('job_post_id', $jobPostId)
            ->with('mitra')
            ->get();

        return response()->json([
            'jobPost' => $jobPost,
            'applications' => $applications,
        ]);
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