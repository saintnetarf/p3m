<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Header extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'logo',
        'institution_name',
        'menu_items',
        'is_active',
    ];

    protected $casts = [
        'menu_items' => 'array',
        'is_active' => 'boolean',
    ];
}
