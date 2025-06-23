<?php
namespace App\Observers;

use App\Models\Setting;
use App\Models\Revenue;

class SettingObserver
{
    /**
     * Handle the Setting "updated" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function updated(Setting $setting)
    {
        if ($setting->key === 'commission_rate') {
            $revenues = Revenue::all();
            foreach ($revenues as $revenue) {
                $platformShare = $revenue->amount * ($setting->value / 100);
                $mitraShare = $revenue->amount - $platformShare;

                // Update revenue data
                $revenue->update([
                    'commission_rate' => $setting->value,
                    'platform_share' => $platformShare,
                    'mitra_share' => $mitraShare,
                ]);
            }
        }
    }
}
