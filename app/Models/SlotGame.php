<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotGame extends Model
{
    protected $fillable = [
        'provider_id',
        'name',
        'slug',
        'rtp',
        'volatility',
        'max_win',
        'release_date',
        'image_url',
        'is_active',
    ];

    protected $casts = [
        'rtp' => 'decimal:2',
        'max_win' => 'decimal:2',
        'release_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
