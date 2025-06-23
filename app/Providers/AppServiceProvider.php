<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Observers\SettingObserver;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Daftarkan observer untuk model Setting
        Setting::observe(SettingObserver::class);
    }

    public function register()
    {
        //
    }
}
