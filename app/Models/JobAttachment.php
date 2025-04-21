<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_post_id',
        'file_name',
        'file_url',
        'file_type',
    ];

    // 🔁 Relationship
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
}
