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
        'service_category',
        'service_area',
        'profile_photo',
        'cover_photo',
        'is_verified',
        'identity_card_number',
        'identity_card_photo',
        'business_license_number',
        'business_license_photo',
        'avg_rating',
        'completed_jobs',
    ];

    protected $casts = [
        'service_area' => 'array', // Cast JSON to array
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skills()
    {
        return $this->hasMany(MitraSkill::class);
    }

    public function portfolio()
    {
        return $this->hasMany(MitraPortfolio::class);
    }
}
