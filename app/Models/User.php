<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo',
        'device_token',
        'email_verified_at',
        'is_active',
        'phone', // pastikan ada kolom ini jika digunakan
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function mitra()
    {
        return $this->hasOne(Mitra::class);
    }

    public function favoritMitra()
    {
        return $this->belongsToMany(Mitra::class, 'mitra_favorit_user', 'user_id', 'mitra_id');
    }

    // Relasi transaksi user
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'customer_id');
    }
}
