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
use Illuminate\Support\Facades\Cache;

class DashboardStatsWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 1;
    protected static bool $isLazy = false;
    
    // Filter properties
    protected int $filterPeriod = 7;
    protected string $comparison = 'previous_period';
    
    // Cache configuration
    protected int $cacheMinutes = 5;
    
    protected function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\Grid::make(2)
                ->schema([
                    \Filament\Forms\Components\Select::make('filterPeriod')
                        ->label('Time Period')
                        ->options([
                            1 => 'Last 24 hours',
                            7 => 'Last 7 days',
                            14 => 'Last 14 days',
                            30 => 'Last 30 days',
                            90 => 'Last 3 months',
                            365 => 'Last year',
                        ])
                        ->default(7)
                        ->reactive()
                        ->afterStateUpdated(fn () => $this->refresh()),
                        
                    \Filament\Forms\Components\Select::make('comparison')
                        ->label('Compare With')
                        ->options([
                            'previous_period' => 'Previous Period',
                            'same_period_last_year' => 'Same Period Last Year',
                            'no_comparison' => 'No Comparison',
                        ])
                        ->default('previous_period')
                        ->reactive()
                        ->afterStateUpdated(fn () => $this->refresh()),
                ]),
        ];
    }

    protected function getStats(): array
    {
        $cacheKey = "dashboard_stats_{$this->filterPeriod}_{$this->comparison}";
        
        return Cache::remember($cacheKey, now()->addMinutes($this->cacheMinutes), function () {
            $currentPeriodData = $this->getCurrentPeriodData();
            $comparisonData = $this->getComparisonData();
            $chartData = $this->getAdvancedChartData();
            
            return [
                $this->createActiveJobsStat($currentPeriodData, $comparisonData, $chartData),
                $this->createCustomersStat($currentPeriodData, $comparisonData, $chartData),
                $this->createMitrasStat($currentPeriodData, $comparisonData, $chartData),
                $this->createApplicationsStat($currentPeriodData, $comparisonData, $chartData),
                $this->createCompletionRateStat($currentPeriodData, $comparisonData, $chartData),
                $this->createRevenueStat($currentPeriodData, $comparisonData, $chartData),
                $this->createEngagementStat($currentPeriodData, $comparisonData, $chartData),
                $this->createPerformanceStat($currentPeriodData, $comparisonData, $chartData),
            ];
        });
    }

    protected function getCurrentPeriodData(): array
    {
        $startDate = now()->subDays($this->filterPeriod);
        $endDate = now();
        
        return [
            'active_jobs' => JobPost::where('status', 'open')->count(),
            'total_customers' => Customer::count(),
            'total_mitras' => Mitra::count(),
            'total_applications' => JobApplication::count(),
            'completed_jobs' => JobPost::where('status', 'completed')->count(),
            'cancelled_jobs' => JobPost::where('status', 'cancelled')->count(),
            'new_customers' => Customer::whereBetween('created_at', [$startDate, $endDate])->count(),
            'new_mitras' => Mitra::whereBetween('created_at', [$startDate, $endDate])->count(),
            'new_applications' => JobApplication::whereBetween('created_at', [$startDate, $endDate])->count(),
            'new_jobs' => JobPost::whereBetween('created_at', [$startDate, $endDate])->count(),
            'jobs_completed_period' => JobPost::where('status', 'completed')
                ->whereBetween('updated_at', [$startDate, $endDate])
                ->count(),
            'avg_response_time' => $this->calculateAverageResponseTime($startDate, $endDate),
            'customer_satisfaction' => $this->calculateCustomerSatisfaction($startDate, $endDate),
            'mitra_efficiency' => $this->calculateMitraEfficiency($startDate, $endDate),
        ];
    }

    protected function getComparisonData(): array
    {
        if ($this->comparison === 'no_comparison') {
            return [];
        }
        
        $comparisonStart = $this->comparison === 'previous_period'
            ? now()->subDays($this->filterPeriod * 2)
            : now()->subYear()->subDays($this->filterPeriod);
            
        $comparisonEnd = $this->comparison === 'previous_period'
            ? now()->subDays($this->filterPeriod)
            : now()->subYear();
        
        return [
            'new_customers' => Customer::whereBetween('created_at', [$comparisonStart, $comparisonEnd])->count(),
            'new_mitras' => Mitra::whereBetween('created_at', [$comparisonStart, $comparisonEnd])->count(),
            'new_applications' => JobApplication::whereBetween('created_at', [$comparisonStart, $comparisonEnd])->count(),
            'new_jobs' => JobPost::whereBetween('created_at', [$comparisonStart, $comparisonEnd])->count(),
            'jobs_completed' => JobPost::where('status', 'completed')
                ->whereBetween('updated_at', [$comparisonStart, $comparisonEnd])
                ->count(),
        ];
    }

    protected function createActiveJobsStat(array $current, array $comparison, array $charts): Stat
    {
        $change = !empty($comparison) ? $this->calculatePercentageChange($current['new_jobs'], $comparison['new_jobs']) : null;
        
        return Stat::make('Active Job Posts', number_format($current['active_jobs']))
            ->description($this->getChangeDescription('new jobs posted', $change, $current['new_jobs']))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['job_posts'])
            ->color($this->getChangeColor($change));
    }

    protected function createCustomersStat(array $current, array $comparison, array $charts): Stat
    {
        $change = !empty($comparison) ? $this->calculatePercentageChange($current['new_customers'], $comparison['new_customers']) : null;
        
        return Stat::make('Total Customers', number_format($current['total_customers']))
            ->description($this->getChangeDescription('new customers', $change, $current['new_customers']))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['customers'])
            ->color($this->getChangeColor($change));
    }

    protected function createMitrasStat(array $current, array $comparison, array $charts): Stat
    {
        $change = !empty($comparison) ? $this->calculatePercentageChange($current['new_mitras'], $comparison['new_mitras']) : null;
        
        return Stat::make('Total Mitras', number_format($current['total_mitras']))
            ->description($this->getChangeDescription('new mitras', $change, $current['new_mitras']))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['mitras'])
            ->color($this->getChangeColor($change));
    }

    protected function createApplicationsStat(array $current, array $comparison, array $charts): Stat
    {
        $avgPerJob = $current['new_jobs'] > 0 
            ? round($current['new_applications'] / $current['new_jobs'], 1) 
            : 0;
        $change = !empty($comparison) ? $this->calculatePercentageChange($current['new_applications'], $comparison['new_applications']) : null;
        
        return Stat::make('Job Applications', number_format($current['total_applications']))
            ->description($this->getChangeDescription("avg {$avgPerJob} per job", $change, $current['new_applications']))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['applications'])
            ->color($this->getChangeColor($change));
    }

    protected function createCompletionRateStat(array $current, array $comparison, array $charts): Stat
    {
        $totalFinished = $current['completed_jobs'] + $current['cancelled_jobs'];
        $completionRate = $totalFinished > 0 
            ? round(($current['completed_jobs'] / $totalFinished) * 100, 1) 
            : 0;
        
        $comparisonRate = 0;
        if (!empty($comparison)) {
            $comparisonTotal = $comparison['jobs_completed'] ?? 0;
            $comparisonRate = $comparisonTotal > 0 ? round(($comparison['jobs_completed'] / $comparisonTotal) * 100, 1) : 0;
        }
        
        $change = $comparisonRate > 0 ? $completionRate - $comparisonRate : null;
        
        return Stat::make('Success Rate', "{$completionRate}%")
            ->description($this->getChangeDescription('completion rate', $change, $current['jobs_completed_period'], '%'))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['completion_rate'])
            ->color($this->getChangeColor($change));
    }

    protected function createRevenueStat(array $current, array $comparison, array $charts): Stat
    {
        // Assuming you have revenue data - replace with actual calculation
        $estimatedRevenue = $current['jobs_completed_period'] * 50000; // Example calculation
        $change = !empty($comparison) ? $this->calculatePercentageChange($estimatedRevenue, ($comparison['jobs_completed'] ?? 0) * 50000) : null;
        
        return Stat::make('Est. Revenue', 'Rp ' . number_format($estimatedRevenue / 1000, 0) . 'K')
            ->description($this->getChangeDescription('estimated revenue', $change))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['revenue'])
            ->color($this->getChangeColor($change));
    }

    protected function createEngagementStat(array $current, array $comparison, array $charts): Stat
    {
        $engagementScore = $this->calculateEngagementScore($current);
        
        return Stat::make('Engagement Score', number_format($engagementScore, 1))
            ->description("Response time: {$current['avg_response_time']}h avg")
            ->descriptionIcon('heroicon-m-chart-bar-square')
            ->chart($charts['engagement'])
            ->color('info');
    }

    protected function createPerformanceStat(array $current, array $comparison, array $charts): Stat
    {
        $performanceScore = ($current['customer_satisfaction'] + $current['mitra_efficiency']) / 2;
        
        return Stat::make('Performance Index', number_format($performanceScore, 1) . '/10')
            ->description("Satisfaction: {$current['customer_satisfaction']}/10, Efficiency: {$current['mitra_efficiency']}/10")
            ->descriptionIcon('heroicon-m-star')
            ->chart($charts['performance'])
            ->color('warning');
    }

    protected function getAdvancedChartData(): array
    {
        $startDate = now()->subDays($this->filterPeriod);
        $endDate = now();
        
        return [
            'job_posts' => $this->getModelTrendData(JobPost::class, $startDate, $endDate),
            'customers' => $this->getModelTrendData(Customer::class, $startDate, $endDate),
            'mitras' => $this->getModelTrendData(Mitra::class, $startDate, $endDate),
            'applications' => $this->getModelTrendData(JobApplication::class, $startDate, $endDate),
            'completion_rate' => $this->getCompletionRateTrendData($startDate, $endDate),
            'revenue' => $this->getRevenueTrendData($startDate, $endDate),
            'engagement' => $this->getEngagementTrendData($startDate, $endDate),
            'performance' => $this->getPerformanceTrendData($startDate, $endDate),
        ];
    }

    protected function getModelTrendData($modelClass, $startDate, $endDate): array
    {
        $records = $modelClass::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();
            
        return $this->generateDataPoints($startDate, $endDate, function ($date) use ($records) {
            return $records[$date->format('Y-m-d')] ?? 0;
        });
    }

    protected function getCompletionRateTrendData($startDate, $endDate): array
    {
        $completedJobs = JobPost::select(
            DB::raw('DATE(updated_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();
            
        $totalJobs = JobPost::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();
            
        return $this->generateDataPoints($startDate, $endDate, function ($date) use ($completedJobs, $totalJobs) {
            $dateStr = $date->format('Y-m-d');
            $completed = $completedJobs[$dateStr] ?? 0;
            $total = $totalJobs[$dateStr] ?? 1;
            return round(($completed / $total) * 100);
        });
    }

    protected function getRevenueTrendData($startDate, $endDate): array
    {
        // Replace with actual revenue calculation logic
        return $this->generateDataPoints($startDate, $endDate, function ($date) {
            $completed = JobPost::where('status', 'completed')
                ->whereDate('updated_at', $date)
                ->count();
            return $completed * 50; // Example: 50k per job
        });
    }

    protected function getEngagementTrendData($startDate, $endDate): array
    {
        return $this->generateDataPoints($startDate, $endDate, function ($date) {
            $applications = JobApplication::whereDate('created_at', $date)->count();
            $jobs = JobPost::whereDate('created_at', $date)->count();
            return $jobs > 0 ? round($applications / $jobs, 1) : 0;
        });
    }

    protected function getPerformanceTrendData($startDate, $endDate): array
    {
        return $this->generateDataPoints($startDate, $endDate, function ($date) {
            // Calculate daily performance score
            return rand(75, 95) / 10; // Example implementation
        });
    }

    protected function generateDataPoints($startDate, $endDate, callable $valueCallback): array
    {
        $data = [];
        $current = clone $startDate;
        
        while ($current <= $endDate) {
            $data[] = $valueCallback($current);
            $current->addDay();
        }
        
        return $data;
    }

    protected function calculatePercentageChange(?int $current, ?int $previous): ?float
    {
        if ($previous === null || $previous === 0) {
            return null;
        }
        
        return round((($current - $previous) / $previous) * 100, 1);
    }

    protected function getChangeDescription(string $metric, ?float $change, int $count = 0, string $suffix = ''): string
    {
        if ($change === null) {
            return "{$count} {$metric} this period";
        }
        
        $direction = $change >= 0 ? 'increase' : 'decrease';
        $absChange = abs($change);
        
        return "{$absChange}% {$direction} in {$metric}{$suffix}";
    }

    protected function getChangeIcon(?float $change): string
    {
        if ($change === null) {
            return 'heroicon-m-minus';
        }
        
        return $change >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
    }

    protected function getChangeColor(?float $change): string
    {
        if ($change === null) {
            return 'gray';
        }
        
        return $change >= 0 ? 'success' : 'danger';
    }

    // Helper methods for calculating metrics
    protected function calculateAverageResponseTime($startDate, $endDate): float
    {
        $applications = JobApplication::whereBetween('created_at', [$startDate, $endDate])
            ->whereColumn('updated_at', '!=', 'created_at') // Ensure updated_at is different
            ->get();
            
        if ($applications->isEmpty()) {
            return 0;
        }
        
        $totalHours = $applications->sum(function ($app) {
            return $app->created_at->diffInHours($app->updated_at);
        });
        
        return round($totalHours / $applications->count(), 1);
    }

    protected function calculateCustomerSatisfaction($startDate, $endDate): float
    {
        // Implement actual satisfaction calculation
        // Placeholder implementation
        return round(rand(75, 95) / 10, 1); // Returns 7.5 to 9.5
    }

    protected function calculateMitraEfficiency($startDate, $endDate): float
    {
        // Implement actual efficiency calculation
        // Placeholder implementation
        return round(rand(80, 95) / 10, 1); // Returns 8.0 to 9.5
    }

    protected function calculateEngagementScore(array $data): float
    {
        // Custom engagement score calculation
        $applicationRate = $data['new_jobs'] > 0 ? $data['new_applications'] / $data['new_jobs'] : 0;
        $completionRate = $data['total_applications'] > 0 ? $data['completed_jobs'] / $data['total_applications'] : 0;
        $growthRate = ($data['new_customers'] + $data['new_mitras']) / 2;
        
        return round(($applicationRate * 0.4 + $completionRate * 0.4 + $growthRate * 0.2) * 10, 1);
    }

    protected function getViewData(): array
    {
        return [
            'column_span' => 'full',
        ];
    }

    public function getHeading(): ?string
    {
        return 'Business Analytics Dashboard';
    }

    public function getDescription(): ?string
    {
        $period = match($this->filterPeriod) {
            1 => 'last 24 hours',
            7 => 'last 7 days',
            14 => 'last 2 weeks',
            30 => 'last month',
            90 => 'last 3 months',
            365 => 'last year',
            default => "last {$this->filterPeriod} days"
        };
        
        return "Comprehensive business metrics and trends for the {$period}";
    }
}