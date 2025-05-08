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

    // Relationships
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
        return $this->belongsTo(Mitra::class);
    }
    
}
