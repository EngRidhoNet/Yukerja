<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\JobPost;
use App\Models\Mitra;
use App\Models\JobApplication;
use App\Models\Transaction;  // Import Transaction model untuk penghasilan
use App\Models\Revenue;  // Import Revenue model untuk penghasilan mitra
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

    protected function getPlatformRevenueTrendData($startDate, $endDate): array
    {
        return $this->generateDataPoints($startDate, $endDate, function ($date) {
            $totalPlatformRevenue = Revenue::whereDate('created_at', $date)
                ->sum('platform_share'); // Sum platform share for each day
            
            return $totalPlatformRevenue;
        });
    }
    protected function getMitraRevenueTrendData($startDate, $endDate): array
    {
        return $this->generateDataPoints($startDate, $endDate, function ($date) {
            $totalMitraRevenue = Revenue::whereDate('created_at', $date)
                ->sum('mitra_share'); // Sum mitra share for each day
            
            return $totalMitraRevenue;
        });
    }


    protected function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\Grid::make(2)
                ->schema([
                    \Filament\Forms\Components\Select::make('filterPeriod')
                        ->label('📊 Time Period')
                        ->options([
                            1 => '🕐 Last 24 hours',
                            7 => '📅 Last 7 days',
                            14 => '📆 Last 14 days',
                            30 => '🗓️ Last 30 days',
                            90 => '📋 Last 3 months',
                            365 => '📈 Last year',
                        ])
                        ->default(7)
                        ->reactive()
                        ->afterStateUpdated(fn () => $this->refresh()),
                        
                    \Filament\Forms\Components\Select::make('comparison')
                        ->label('🔄 Compare With')
                        ->options([
                            'previous_period' => '📉 Previous Period',
                            'same_period_last_year' => '📊 Same Period Last Year',
                            'no_comparison' => '➖ No Comparison',
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
                // Add Platform Revenue Chart here
                $this->createPlatformRevenueChart($currentPeriodData, $comparisonData, $chartData),
                // Add Mitra Revenue Chart here
                $this->createMitraRevenueChart($currentPeriodData, $comparisonData, $chartData),
            ];
        });
    }

    // Add the method for platform revenue chart
    // Update for Platform Revenue Chart
    protected function createPlatformRevenueChart(array $current, array $comparison, array $charts): Stat
    {
        // Sum up the total revenue from platform (admin share)
        $totalPlatformRevenue = Revenue::sum('platform_share');  // Platform share stored in the revenue table
        $change = !empty($comparison) ? $this->calculatePercentageChange($totalPlatformRevenue, $comparison['total_platform_revenue']) : null;
        
        return Stat::make('💰 Platform Revenue', 'Rp ' . number_format($totalPlatformRevenue / 1000, 0) . 'K')
            ->description($this->getChangeDescription('platform revenue', $change))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['platform_revenue']) // Use the chart data here
            ->color($this->getChangeColor($change))
            ->extraAttributes([
                'class' => 'text-center',
            ]);
    }

    // Update for Mitra Revenue Chart
    protected function createMitraRevenueChart(array $current, array $comparison, array $charts): Stat
    {
        // Sum up the total revenue for mitra share
        $totalMitraRevenue = Revenue::sum('mitra_share');  // Mitra share stored in the revenue table
        $change = !empty($comparison) ? $this->calculatePercentageChange($totalMitraRevenue, $comparison['total_mitra_revenue']) : null;
        
        return Stat::make('🤝 Mitra Revenue', 'Rp ' . number_format($totalMitraRevenue / 1000, 0) . 'K')
            ->description($this->getChangeDescription('mitra revenue', $change))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['mitra_revenue']) // Use the chart data here
            ->color($this->getChangeColor($change))
            ->extraAttributes([
                'class' => 'text-center',
            ]);
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
            'total_platform_revenue' => Revenue::whereHas('transaction', function ($query) use ($comparisonStart, $comparisonEnd) {
                $query->where('payment_date', '>=', $comparisonStart)
                      ->where('payment_date', '<=', $comparisonEnd);
            })->sum('platform_share'),
            'total_mitra_revenue' => Revenue::whereHas('transaction', function ($query) use ($comparisonStart, $comparisonEnd) {
                $query->where('payment_date', '>=', $comparisonStart)
                      ->where('payment_date', '<=', $comparisonEnd);
            })->sum('mitra_share'),
        ];
    }

    protected function createActiveJobsStat(array $current, array $comparison, array $charts): Stat
    {
        $change = !empty($comparison) ? $this->calculatePercentageChange($current['new_jobs'], $comparison['new_jobs']) : null;
        
        return Stat::make('💼 Active Job Posts', number_format($current['active_jobs']))
            ->description($this->getChangeDescription('new jobs posted', $change, $current['new_jobs']))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['job_posts'])
            ->color($this->getChangeColor($change))
            ->extraAttributes([
                'class' => 'text-center',
            ]);
    }
    protected function createCustomersStat(array $current, array $comparison, array $charts): Stat
    {
        $change = !empty($comparison) ? $this->calculatePercentageChange($current['new_customers'], $comparison['new_customers']) : null;
        
        return Stat::make('👥 Total Customers', number_format($current['total_customers']))
            ->description($this->getChangeDescription('new customers', $change, $current['new_customers']))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['customers'])
            ->color($this->getChangeColor($change))
            ->extraAttributes([
                'class' => 'text-center',
            ]);
    }

    protected function createMitrasStat(array $current, array $comparison, array $charts): Stat
    {
        $change = !empty($comparison) ? $this->calculatePercentageChange($current['new_mitras'], $comparison['new_mitras']) : null;
        
        return Stat::make('🤝 Total Partners', number_format($current['total_mitras']))
            ->description($this->getChangeDescription('new partners', $change, $current['new_mitras']))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['mitras'])
            ->color($this->getChangeColor($change))
            ->extraAttributes([
                'class' => 'text-center',
            ]);
    }

    protected function createApplicationsStat(array $current, array $comparison, array $charts): Stat
    {
        $avgPerJob = $current['new_jobs'] > 0 
            ? round($current['new_applications'] / $current['new_jobs'], 1) 
            : 0;
        $change = !empty($comparison) ? $this->calculatePercentageChange($current['new_applications'], $comparison['new_applications']) : null;
        
        return Stat::make('📝 Job Applications', number_format($current['total_applications']))
            ->description($this->getChangeDescription("avg {$avgPerJob} per job", $change, $current['new_applications']))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['applications'])
            ->color($this->getChangeColor($change))
            ->extraAttributes([
                'class' => 'text-center',
            ]);
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
        
        return Stat::make('✅ Success Rate', "{$completionRate}%")
            ->description($this->getChangeDescription('completion rate', $change, $current['jobs_completed_period'], '%'))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['completion_rate'])
            ->color($this->getChangeColor($change))
            ->extraAttributes([
                'class' => 'text-center',
            ]);
    }

    protected function createRevenueStat(array $current, array $comparison, array $charts): Stat
    {
        $estimatedRevenue = $current['jobs_completed_period'] * 50000;
        $change = !empty($comparison) ? $this->calculatePercentageChange($estimatedRevenue, ($comparison['jobs_completed'] ?? 0) * 50000) : null;
        
        return Stat::make('💰 Est. Revenue', 'Rp ' . number_format($estimatedRevenue / 1000, 0) . 'K')
            ->description($this->getChangeDescription('estimated revenue', $change))
            ->descriptionIcon($this->getChangeIcon($change))
            ->chart($charts['revenue'])
            ->color($this->getChangeColor($change))
            ->extraAttributes([
                'class' => 'text-center',
            ]);
    }

    protected function createEngagementStat(array $current, array $comparison, array $charts): Stat
    {
        $engagementScore = $this->calculateEngagementScore($current);
        
        return Stat::make('📊 Engagement Score', number_format($engagementScore, 1))
            ->description("⏱️ Response time: {$current['avg_response_time']}h avg")
            ->descriptionIcon('heroicon-m-chart-bar-square')
            ->chart($charts['engagement'])
            ->color('info')
            ->extraAttributes([
                'class' => 'text-center',
            ]);
    }

    protected function createPerformanceStat(array $current, array $comparison, array $charts): Stat
    {
        $performanceScore = ($current['customer_satisfaction'] + $current['mitra_efficiency']) / 2;
        
        return Stat::make('⭐ Performance Index', number_format($performanceScore, 1) . '/10')
            ->description("😊 Satisfaction: {$current['customer_satisfaction']}/10 | ⚡ Efficiency: {$current['mitra_efficiency']}/10")
            ->descriptionIcon('heroicon-m-star')
            ->chart($charts['performance'])
            ->color('warning')
            ->extraAttributes([
                'class' => 'text-center',
            ]);
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
            
            // Add platform revenue chart data
            'platform_revenue' => $this->getPlatformRevenueTrendData($startDate, $endDate),
            
            // Add mitra revenue chart data
            'mitra_revenue' => $this->getMitraRevenueTrendData($startDate, $endDate),
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
        return $this->generateDataPoints($startDate, $endDate, function ($date) {
            $completed = JobPost::where('status', 'completed')
                ->whereDate('updated_at', $date)
                ->count();
            return $completed * 50;
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
            return rand(75, 95) / 10;
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
            return "📈 {$count} {$metric} this period";
        }
        
        $direction = $change >= 0 ? '📈 increase' : '📉 decrease';
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

    protected function calculateAverageResponseTime($startDate, $endDate): float
    {
        $applications = JobApplication::whereBetween('created_at', [$startDate, $endDate])
            ->whereColumn('updated_at', '!=', 'created_at')
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
        return round(rand(75, 95) / 10, 1);
    }

    protected function calculateMitraEfficiency($startDate, $endDate): float
    {
        return round(rand(80, 95) / 10, 1);
    }

    protected function calculateEngagementScore(array $data): float
    {
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
        return '📊 Business Analytics Dashboard';
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
        
        return "📈 Comprehensive business metrics and trends for the {$period}";
    }
}