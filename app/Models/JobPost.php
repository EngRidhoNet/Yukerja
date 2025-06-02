<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'service_category_id',
        'title',
        'description',
        'category',
        'latitude',
        'longitude',
        'address',
        'budget',
        'scheduled_date',
        'completion_deadline',
        'status',
        'cancellation_reason',
    ];

    // 🔁 Relationships
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function attachments()
    {
        return $this->hasMany(JobAttachment::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
