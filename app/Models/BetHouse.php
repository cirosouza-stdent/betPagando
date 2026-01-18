<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BetHouse extends Model
{
    protected $fillable = [
        'name',
        'link',
        'current_balance',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'current_balance' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
