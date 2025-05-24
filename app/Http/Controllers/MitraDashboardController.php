<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Notification;
use App\Models\Report;
use App\Models\ServiceCategory;
use App\Models\Transaction;
use App\Models\TransactionLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraDashboardController extends Controller
{
    public function index(Request $request)
    {
        try {
            $mitra = Auth::user();
        
            $query = JobPost::where('status', 'open')
                ->whereHas('service_category', function ($q) use ($mitra) {
                    $q->where('name', $mitra->service_category);
                });

            // Apply filters
            if ($request->category) {
                $query->where('service_category_id', $request->category);
            }
            if ($request->distance) {
                $query->whereRaw('ST_Distance_Sphere(
                    POINT(?, ?),
                    POINT(latitude, longitude)
                ) / 1000 <= ?', [$mitra->latitude, $mitra->longitude, $request->distance == '10+' ? 999 : $request->distance]);
            }

            $pendingJobs = $query->latest()->paginate(10);
            $activeJobs = JobPost::where('status', 'open')
                ->orWhereHas('job_applications', function ($q) use ($mitra) {
                    $q->where('mitra_id', $mitra->id)->where('status', 'accepted');
                })->count();
            $activeJobsTrend = $this->calculateTrend(JobPost::class, 'week');
            $completedJobsTrend = $this->calculateTrend(Transaction::class, 'month', ['mitra_id' => $mitra->id]);
            $reviewsCount = $mitra->reviews()->count();
            $violationsCount = Report::where('reported_id', Auth::user()->id)->count();
            $notifications = Notification::where('user_id', Auth::user()->id)->latest()->get();
            dd($notifications);
                
            $recentActivities = TransactionLog::whereHas('transaction', function ($q) use ($mitra) {
                $q->where('mitra_id', $mitra->id);
            })->latest()->take(4)->get()->map(function ($log) {
                return [
                    'description' => $log->description,
                    'created_at' => $log->created_at,
                    'type_color' => $this->getActivityColor($log->status),
                    'icon_path' => $this->getActivityIcon($log->status),
                ];
            });
            $incomeChart = $this->getIncomeChartData($mitra->id);
            $categories = ServiceCategory::where('is_active', true)->get();

            return view('mitra.dashboard', compact(
                'pendingJobs',
                'activeJobs',
                'activeJobsTrend',
                'completedJobsTrend',
                'reviewsCount',
                'violationsCount',
                'notifications',
                'recentActivities',
                'incomeChart',
                'categories'
            ));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error in MitraDashboardController::index: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'An error occurred while loading the dashboard.');
        }
    }

    private function calculateTrend($model, $period, $conditions = [])
    {
        $current = $model::where($conditions)->whereBetween('created_at', [
            now()->startOf($period),
            now()->endOf($period)
        ])->count();

        $previous = $model::where($conditions)->whereBetween('created_at', [
            now()->sub($period)->startOf($period),
            now()->sub($period)->endOf($period)
        ])->count();

        return $previous > 0 ? round(($current - $previous) / $previous * 100, 1) : 0;
    }

    private function getIncomeChartData($mitraId)
    {
        $data = [];
        $labels = [];
        for ($i = 4; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $labels[] = $month->format('M');
            $data[] = Transaction::where('mitra_id', $mitraId)
                ->where('payment_status', 'completed')
                ->whereMonth('payment_date', $month->month)
                ->whereYear('payment_date', $month->year)
                ->sum('mitra_earning');
        }
        return ['labels' => $labels, 'data' => $data];
    }

    private function getActivityColor($status)
    {
        return match ($status) {
            'completed' => 'green',
            'pending' => 'yellow',
            'failed' => 'red',
            default => 'blue',
        };
    }

    private function getActivityIcon($status)
    {
        return match ($status) {
            'completed' => 'M9 12l2 2 4-4m6 0a9 9 0 11-18 0 9 9 0 0118 0z',
            'pending' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            'failed' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
            default => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
        };
    }

    // Placeholder methods for other routes
    public function nearbyJobs() { /* Implement logic */ }
    public function history() { /* Implement logic */ }
    public function serviceArea() { /* Implement logic */ }
    public function offers() { /* Implement logic */ }
    public function editProfile() { /* Implement logic */ }
    public function settings() { /* Implement logic */ }
    public function notifications() { /* Implement logic */ }
    public function activities() { /* Implement logic */ }
    public function reports() { /* Implement logic */ }
    public function jobDetail($id) { /* Implement logic */ }
    public function acceptJob($id) { /* Implement logic to create job_application */ }
}