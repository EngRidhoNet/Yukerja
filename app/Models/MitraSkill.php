<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'mitra_id',
        'skill_name',
        'experience_years',
        'certification',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
}
