<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan jika tidak sesuai dengan nama model
    protected $table = 'revenues';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'transaction_id',
        'amount',
        'commission_rate',
        'platform_share',
        'mitra_share'
    ];

    // Relasi ke transaksi
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Relasi ke setting (untuk mengakses nilai commission_rate jika diperlukan)
    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }
}
