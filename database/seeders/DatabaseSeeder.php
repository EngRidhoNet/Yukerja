<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            $this->call([
        ServiceCategorySeeder::class, 
        MitraSeeder::class,
        SettingSeeder::class,
        TransactionSeeder::class,
    ]);
    }
}
