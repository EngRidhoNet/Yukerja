<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraPortfolio extends Model
{
    use HasFactory;

    protected $table = "mitra_portfolio";

    protected $fillable = [
        'mitra_id',
        'title',
        'description',
        'image_url',
        'completion_date',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
}
