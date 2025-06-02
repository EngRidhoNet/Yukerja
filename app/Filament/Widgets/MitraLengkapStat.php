<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class MitraLengkapStat extends BaseWidget
{
    protected function getCards(): array
    {
        $totalMitra = User::where('role', 'mitra')->count();

        // Asumsikan ada relasi `mitra` di model User (hasOne)
        $mitraLengkap = User::where('role', 'mitra')->whereHas('mitra')->count();

        return [
            Card::make('Total Mitra', $totalMitra),
            Card::make('Profil Usaha Lengkap', $mitraLengkap),
        ];
    }
}
