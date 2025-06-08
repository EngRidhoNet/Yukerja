<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';

    protected $fillable = [
        'name',
        'icon',
        'description',
        'is_active',
    ];
}
