<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run()
    {
        // Hapus entri yang sudah ada dengan key 'commission_rate'
        Setting::where('key', 'commission_rate')->delete();

        // Insert data baru
        Setting::create([
            'key' => 'commission_rate',
            'value' => 20.00,  // 20% fee
            'updated_by' => 1,  // Admin ID (sesuaikan dengan ID admin yang ada)
        ]);
        Setting::updateOrCreate(
            ['key' => 'commission_rate'],  // Kondisi pencarian berdasarkan key
            ['value' => 20.00, 'updated_by' => 1]  // Data yang akan diperbarui atau dibuat
        );
    }
}
