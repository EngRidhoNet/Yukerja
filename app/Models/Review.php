<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'mitra_id',
        'job_post_id',
        'rating',
        'comment',
        'mitra_response',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'rating' => 'integer',
    ];
    

    /**
     * Relasi ke model Customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relasi ke model Mitra.
     */
    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    /**
     * Relasi ke model JobPost.
     */
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
}
