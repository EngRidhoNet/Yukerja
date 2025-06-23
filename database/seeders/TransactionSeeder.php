<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Revenue;
use App\Models\Setting;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        // Ambil nilai commission_rate dari settings
        $setting = Setting::where('key', 'commission_rate')->first();
        $commission_rate = $setting ? $setting->value : 20.00;  // Default ke 20% jika tidak ditemukan

        // Buat transaksi baru untuk uji coba
        $transaction = Transaction::create([
            'job_post_id' => 1,
            'customer_id' => 1,
            'mitra_id' => 1,
            'amount' => 100000,
            'payment_status' => 'completed',
            'payment_method' => 'bank_transfer',
            'invoice_number' => 'INV12345',
            'payment_date' => now(),
            'transaction_reference' => 'TXN12345',
        ]);

        // Hitung platform_share dan mitra_share
        $platform_share = $transaction->amount * ($commission_rate / 100);
        $mitra_share = $transaction->amount - $platform_share;

        // Simpan perhitungan bagi hasil ke tabel revenues
        Revenue::create([
            'transaction_id' => $transaction->id,
            'amount' => $transaction->amount,
            'commission_rate' => $commission_rate,
            'platform_share' => $platform_share,
            'mitra_share' => $mitra_share,
        ]);
    }
}
