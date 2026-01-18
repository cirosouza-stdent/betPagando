<?php

namespace App\Http\Controllers;

use App\Models\Provider;

class SlotCatalogController extends Controller
{
    public function index()
    {
        if (auth()->guest()) {
            return view('welcome');
        }

        $providers = Provider::query()
            ->with(['slotGames' => function ($query) {
                $query->where('is_active', true)
                    ->orderByDesc('rtp');
            }])
            ->orderBy('name')
            ->get()
            ->map(function (Provider $provider) {
                $games = $provider->slotGames;
                $provider->stats = [
                    'count' => $games->count(),
                    'avg_rtp' => $games->avg('rtp'),
                    'min_rtp' => $games->min('rtp'),
                    'max_rtp' => $games->max('rtp'),
                ];

                return $provider;
            });

        $globalStats = [
            'providers' => $providers->count(),
            'games' => $providers->sum(fn (Provider $provider) => $provider->slotGames->count()),
            'avg_rtp' => $providers->flatMap->slotGames->avg('rtp'),
        ];

        return view('slots.index', compact('providers', 'globalStats'));
    }
}
