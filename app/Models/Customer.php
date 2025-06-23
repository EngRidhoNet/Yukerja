<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'latitude',
        'longitude',
        'loyalty_points',
        'identity_card_number',
        'identity_card_photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
