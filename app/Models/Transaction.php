<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_name',
        'service_detail',
        'price',
        'total_price',
        'status',
        'note',
        'service_image',
        // tambahkan kolom lain sesuai struktur tabelmu
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
