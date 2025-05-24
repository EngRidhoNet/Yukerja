<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobPost;
use App\Models\JobApplication;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\Report;
use App\Models\Mitra;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceCategory;

class MitraDashboardController extends Controller
{
    public function index()
    {
        $mitra = Auth::user()->mitra;
        $user = Auth::user();

        // Statistics
        $activeJobs = JobApplication::where('mitra_id', $mitra->id)
            ->where('status', 'accepted')
            ->count();

        $completedJobs = $mitra->completed_jobs;

        $avgRating = $mitra->avg_rating;

        $violations = Report::where('reported_id', $user->id)
            ->where('status', 'confirmed')
            ->count();

        // Pending Jobs
        $pendingJobs = JobPost::join('job_applications', 'job_posts.id', '=', 'job_applications.job_post_id')
            ->where('job_applications.mitra_id', $mitra->id)
            ->where('job_applications.status', 'pending')
            ->select('job_posts.*', 'job_applications.bid_amount', 'job_applications.estimated_completion_time')
            ->get();

        // Recent Activities (using notifications)
        $recentActivities = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Notifications
        $notifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Income Data (last 5 months)
        $incomeData = Transaction::where('mitra_id', $mitra->id)
            ->where('payment_status', 'completed')
            ->where('payment_date', '>=', Carbon::now()->subMonths(5))
            ->groupBy(DB::raw('YEAR(payment_date), MONTH(payment_date)'))
            ->selectRaw('YEAR(payment_date) as year, MONTH(payment_date) as month, SUM(mitra_earning) as total')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::create($item->year, $item->month)->format('M'),
                    'total' => $item->total
                ];
            });

        return view('mitra.dashboard', compact(
            'user',
            'mitra',
            'activeJobs',
            'completedJobs',
            'avgRating',
            'violations',
            'pendingJobs',
            'recentActivities',
            'notifications',
            'incomeData'
        ));
    }

    public function nearbyJobs(Request $request)
    {
        $mitra = Auth::user()->mitra;
        $user = Auth::user();

        // Fetch notifications
        $notifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Fetch service categories for filter
        $categories = ServiceCategory::where('is_active', true)->get();

        // Build query for nearby jobs
        $query = JobPost::where('status', 'open')
            ->whereNotIn('id', function ($query) use ($mitra) {
                $query->select('job_post_id')
                    ->from('job_applications')
                    ->where('mitra_id', $mitra->id);
            })
            ->select('job_posts.*')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                [$mitra->latitude, $mitra->longitude, $mitra->latitude]
            )
            ->having('distance', '<', 20); // Jobs within 20 km

        // Apply filters
        if ($request->filled('category')) {
            $query->where('service_category_id', $request->category);
        }

        if ($request->filled('distance')) {
            $query->having('distance', '<=', $request->distance);
        }

        if ($request->filled('budget_min')) {
            $query->where('budget', '>=', $request->budget_min);
        }

        if ($request->filled('budget_max')) {
            $query->where('budget', '<=', $request->budget_max);
        }

        // Apply sorting
        $sort = $request->input('sort', 'distance');
        $direction = $request->input('direction', 'asc');

        if ($sort === 'budget') {
            $query->orderBy('budget', $direction);
        } elseif ($sort === 'date') {
            $query->orderBy('scheduled_date', $direction);
        } else {
            $query->orderBy('distance', $direction);
        }

        // Paginate results
        $jobs = $query->paginate(10);

        return view('mitra.job-terdekat', compact(
            'user',
            'mitra',
            'jobs',
            'categories',
            'notifications'
        ));
    }
}