<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\JobPost;
use App\Models\Mitra;
use App\Models\JobApplication;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class DashboardStatsWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';
    
    // Add filter options for time periods
    protected int $filterPeriod = 7; // Default to 7 days
    
    protected function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\Select::make('filterPeriod')
                ->label('Time Period')
                ->options([
                    7 => 'Last 7 days',
                    14 => 'Last 14 days',
                    30 => 'Last 30 days',
                    90 => 'Last 3 months',
                ])
                ->default(7)
                ->reactive()
                ->afterStateUpdated(fn () => $this->refresh()),
        ];
    }

    protected function getStats(): array
    {
        // Fetch more comprehensive statistics
        $totalJobPosts = JobPost::where('status', 'open')->count();
        $totalCustomers = Customer::count();
        $totalMitras = Mitra::count();
        $totalApplications = JobApplication::count();
        $completedJobs = JobPost::where('status', 'completed')->count();
        $newCustomersToday = Customer::whereDate('created_at', Carbon::today())->count();
        $newMitrasToday = Mitra::whereDate('created_at', Carbon::today())->count();
        
        // Get completion rate
        $totalFinishedJobs = JobPost::whereIn('status', ['completed', 'cancelled'])->count();
        $completionRate = $totalFinishedJobs > 0 
            ? round(($completedJobs / $totalFinishedJobs) * 100, 1) 
            : 0;
        
        // Get average applications per job
        $avgApplicationsPerJob = JobPost::count() > 0 
            ? round($totalApplications / JobPost::count(), 1) 
            : 0;
        
        // Enhanced chart data
        $chartData = $this->getChartData();

        return [
            Stat::make('Active Job Posts', $totalJobPosts)
                ->description('Open jobs available')
                ->descriptionIcon('heroicon-m-briefcase')
                ->chart($chartData['jobPostsData'])
                ->color('primary'),
                
            Stat::make('Total Customers', $totalCustomers)
                ->description("$newCustomersToday new today")
                ->descriptionIcon('heroicon-m-users')
                ->chart($chartData['customerData'])
                ->color('success'),
                
            Stat::make('Total Mitras', $totalMitras)
                ->description("$newMitrasToday new today")
                ->descriptionIcon('heroicon-m-user-group')
                ->chart($chartData['mitraData'])
                ->color('warning'),
                
            Stat::make('Job Completion Rate', "$completionRate%")
                ->description('Successfully completed jobs')
                ->descriptionIcon('heroicon-m-check-circle')
                ->chart($chartData['completionRateData'])
                ->color('info'),
                
            Stat::make('Applications', $totalApplications)
                ->description("Avg $avgApplicationsPerJob per job")
                ->descriptionIcon('heroicon-m-document-text')
                ->chart($chartData['applicationData'])
                ->color('danger'),
                
            Stat::make('User Engagement', '')
                ->description('Customer vs. Mitra growth')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->chart([$chartData['customerData'][3], $chartData['mitraData'][3]])
                ->color('gray'),
        ];
    }

    protected function getChartData(): array
    {
        $days = $this->filterPeriod;
        $interval = "$days days";
        $startDate = now()->subDays($days);
        $endDate = now();
    
        // Job posts data
        $jobPosts = $this->getModelTrendData(JobPost::class, $startDate, $endDate);
        
        // Customer data
        $customers = $this->getModelTrendData(Customer::class, $startDate, $endDate);
        
        // Mitra data
        $mitras = $this->getModelTrendData(Mitra::class, $startDate, $endDate);
        
        // Applications data
        $applications = $this->getModelTrendData(JobApplication::class, $startDate, $endDate);
        
        // Completion rate data over time - using updated_at instead of completed_at
        // Assuming jobs are marked as completed by updating their status
        $completedJobsOverTime = JobPost::select(
            DB::raw('DATE(updated_at) as date'),
            DB::raw('COUNT(*) as completed')
        )
            ->where('status', 'completed')
            ->where('updated_at', '>=', $startDate)
            ->groupBy('date')
            ->pluck('completed', 'date')
            ->toArray();
            
        $totalJobsOverTime = JobPost::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();
            
        $completionRateData = $this->generateDataPoints($startDate, $endDate, function ($date) use ($completedJobsOverTime, $totalJobsOverTime) {
            $dateStr = $date->format('Y-m-d');
            $completed = $completedJobsOverTime[$dateStr] ?? 0;
            $total = $totalJobsOverTime[$dateStr] ?? 0;
            return $total > 0 ? round(($completed / $total) * 100) : 0;
        });
    
        return [
            'jobPostsData' => $jobPosts,
            'customerData' => $customers,
            'mitraData' => $mitras,
            'applicationData' => $applications,
            'completionRateData' => $completionRateData,
        ];
    }
    
    protected function getModelTrendData($modelClass, $startDate, $endDate)
    {
        $records = $modelClass::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();
            
        return $this->generateDataPoints($startDate, $endDate, function ($date) use ($records) {
            $dateStr = $date->format('Y-m-d');
            return $records[$dateStr] ?? 0;
        });
    }
    
    protected function generateDataPoints($startDate, $endDate, callable $valueCallback)
    {
        $data = [];
        $currentDate = clone $startDate;
        
        while ($currentDate <= $endDate) {
            $data[] = $valueCallback($currentDate);
            $currentDate->addDay();
        }
        
        return $data;
    }
    
    protected function getViewData(): array
    {
        return [
            'column_span' => match(count($this->getStats())) {
                3 => 'full',
                4 => 'full',
                6 => 'full',
                default => 'full',
            },
        ];
    }
}