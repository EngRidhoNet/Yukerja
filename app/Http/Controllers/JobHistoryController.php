<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Notification;
use App\Models\ServiceCategory;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobHistoryController extends Controller
{
    public function index(Request $request)
    {
        $mitra = Auth::user()->mitra;

        // Fetch notifications
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();

        // Fetch active service categories
        $categories = ServiceCategory::where('is_active', true)->get();

        // Build job history query
        $query = JobPost::whereHas('applications', function ($q) use ($mitra) {
                $q->where('mitra_id', $mitra->id)
                  ->where('status', 'pending');
            })
            ->with(['serviceCategory', 'reviews', 'applications' => function ($q) use ($mitra) {
                $q->where('mitra_id', $mitra->id)->where('status', 'accepted');
            }]);

        // Apply filters
        if ($request->filled('category')) {
            $query->where('service_category_id', $request->category);
        }

        if ($request->filled('date')) {
            if ($request->date === 'this_month') {
                $query->whereMonth('scheduled_date', now()->month)
                      ->whereYear('scheduled_date', now()->year);
            } elseif ($request->date === 'last_month') {
                $query->whereMonth('scheduled_date', now()->subMonth()->month)
                      ->whereYear('scheduled_date', now()->subMonth()->year);
            } elseif ($request->date === 'this_year') {
                $query->whereYear('scheduled_date', now()->year);
            }
        }

        // Apply sorting
        $sort = $request->input('sort', 'scheduled_date');
        $direction = $request->input('direction', 'desc');
        if ($sort === 'budget') {
            $query->join('job_applications', 'job_posts.id', '=', 'job_applications.job_post_id')
                  ->where('job_applications.mitra_id', $mitra->id)
                  ->where('job_applications.status', 'accepted')
                  ->orderBy('job_applications.bid_amount', $direction);
        } elseif ($sort === 'rating') {
            $query->leftJoin('reviews', 'job_posts.id', '=', 'reviews.job_post_id')
                  ->groupBy('job_posts.id')
                  ->orderByRaw('AVG(reviews.rating) ' . $direction);
        } else {
            $query->orderBy('scheduled_date', $direction);
        }

        // Paginate results
        $jobs = $query->paginate(10)->appends($request->query());

        return view('mitra.riwayat-pekerjaan', compact(
            'notifications',
            'categories',
            'jobs',
            'mitra'
        ));
    }
}