<?php

namespace App\Filament\Widgets;

use App\Models\ServiceCategory;
use Filament\Widgets\BarChartWidget;

class ServiceCategoryChart extends BarChartWidget
{
    protected static ?string $heading = 'Jumlah Kategori Layanan';

    protected function getData(): array
    {
        // Ambil semua nama kategori dan hitung jumlahnya
        $categories = ServiceCategory::select('name')
            ->groupBy('name')
            ->get();

        $labels = [];
        $counts = [];

        foreach ($categories as $category) {
            $labels[] = $category->name;
            $counts[] = ServiceCategory::where('name', $category->name)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kategori',
                    'data' => $counts,
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $labels,
        ];
    }
}
