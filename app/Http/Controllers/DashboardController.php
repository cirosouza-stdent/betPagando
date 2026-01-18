<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\SlotGame;

class DashboardController extends Controller
{
    public function index()
    {
        $providers = Provider::query()
            ->with(['slotGames' => function ($query) {
                $query->where('is_active', true)
                    ->orderByDesc('rtp');
            }])
            ->orderBy('name')
            ->get();

        $topGames = SlotGame::query()
            ->where('is_active', true)
            ->with('provider')
            ->orderByDesc('rtp')
            ->take(6)
            ->get();

        $stats = [
            'providers' => $providers->count(),
            'games' => $providers->sum(fn (Provider $provider) => $provider->slotGames->count()),
            'avg_rtp' => $providers->flatMap->slotGames->avg('rtp'),
        ];

        return view('dashboard', compact('providers', 'topGames', 'stats'));
    }
}
