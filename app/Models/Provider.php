<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo_url',
        'website_url',
        'description',
        'avg_rtp',
        'games_count',
    ];

    public function slotGames()
    {
        return $this->hasMany(SlotGame::class);
    }
}
