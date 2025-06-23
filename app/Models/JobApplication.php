<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_post_id',
        'mitra_id',
        'status',
        'message',
        'bid_amount',
        'estimated_completion_time',
    ];

    // 🔁 Relationships
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function mitra()
    {
        return $this->belongsTo(User::class, 'mitra_id');
    }
}
