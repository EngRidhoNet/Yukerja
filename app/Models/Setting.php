<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan jika tidak sesuai dengan nama model
    protected $table = 'settings';

    // Tentukan kolom yang dapat diisi
    protected $fillable = ['key', 'value', 'updated_by'];

    // Menentukan relasi jika perlu
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
