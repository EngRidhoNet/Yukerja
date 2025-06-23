<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_post_id',
        'customer_id',
        'mitra_id',
        'amount',
        'admin_fee',
        'mitra_earning',
        'payment_status',
        'payment_method',
        'invoice_number',
        'payment_date',
        'transaction_reference',
    ];

    // Pastikan hanya satu deklarasi $casts dan tidak ada duplikasi
    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'mitra_earning' => 'decimal:2',
    ];

    // Relasi ke tabel JobPost
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    // Relasi ke tabel Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi ke tabel Mitra
    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
}
