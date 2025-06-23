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
        'payment_date',
        'invoice_number',
        'xendit_invoice_id',
        'xendit_external_id',
        'payment_url',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'mitra_earning' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function mitra()
    {
        return $this->belongsTo(User::class, 'mitra_id');
    }
}