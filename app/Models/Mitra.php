<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'description',
        'latitude',
        'longitude',
        'service_category_id',
        'service_area',
        'profile_photo',
        'cover_photo',
        'phone_number',
        'operational_hours',
        'is_verified',
        'avg_rating',
        'completed_jobs',
    ];

    protected $casts = [
        'service_area' => 'array',
        'is_verified' => 'boolean',
        'avg_rating' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skills()
    {
        return $this->hasMany(MitraSkill::class);
    }

    public function portfolios()
    {
        return $this->hasMany(MitraPortfolio::class);
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}