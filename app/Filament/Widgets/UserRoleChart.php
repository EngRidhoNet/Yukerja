<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserRoleChart extends ChartWidget
{
    protected static ?string $heading = 'Total User Berdasarkan Role';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $roles = ['admin', 'mitra', 'customer'];
        $data = [];

        foreach ($roles as $role) {
            $data[] = User::where('role', $role)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah User',
                    'data' => $data,
                    'backgroundColor' => ['#6366F1', '#10B981', '#F59E0B'],
                ],
            ],
            'labels' => ['Admin', 'Mitra', 'Customer'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
