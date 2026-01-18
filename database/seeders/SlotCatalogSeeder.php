<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\SlotGame;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SlotCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = [
            [
                'name' => 'PG Soft',
                'description' => 'Estúdio conhecido por slots mobile-first e mecânicas inovadoras.',
                'logo_url' => '/images/providers/pgsoft.svg',
                'games' => [
                    ['name' => 'Fortune Tiger', 'rtp' => 96.81, 'volatility' => 'Alta', 'max_win' => 2500],
                    ['name' => 'Fortune Rabbit', 'rtp' => 96.75, 'volatility' => 'Média', 'max_win' => 2000],
                    ['name' => 'Treasures of Aztec', 'rtp' => 96.71, 'volatility' => 'Alta', 'max_win' => 5000],
                ],
            ],
            [
                'name' => 'Evolution',
                'description' => 'Forte presença em live casino e catálogo de slots premium.',
                'logo_url' => '/images/providers/evolution.svg',
                'games' => [
                    ['name' => 'Gonzo’s Treasure Hunt', 'rtp' => 96.00, 'volatility' => 'Alta', 'max_win' => 5000],
                    ['name' => 'Money Mine', 'rtp' => 96.48, 'volatility' => 'Média', 'max_win' => 2000],
                    ['name' => 'Temple of Thunder', 'rtp' => 96.20, 'volatility' => 'Alta', 'max_win' => 8000],
                ],
            ],
            [
                'name' => 'Spribe',
                'description' => 'Popular por jogos crash e slots ágeis.',
                'logo_url' => '/images/providers/spribe.svg',
                'games' => [
                    ['name' => 'Aviator', 'rtp' => 97.00, 'volatility' => 'Alta', 'max_win' => 2000],
                    ['name' => 'Dice', 'rtp' => 96.00, 'volatility' => 'Baixa', 'max_win' => 1000],
                    ['name' => 'Plinko', 'rtp' => 96.50, 'volatility' => 'Média', 'max_win' => 1500],
                ],
            ],
            [
                'name' => 'Pragmatic Play',
                'description' => 'Provedor global com amplo portfólio de slots e jackpots.',
                'logo_url' => '/images/providers/pragmatic-play.svg',
                'games' => [
                    ['name' => 'Sweet Bonanza', 'rtp' => 96.51, 'volatility' => 'Alta', 'max_win' => 21000],
                    ['name' => 'Gates of Olympus', 'rtp' => 96.50, 'volatility' => 'Alta', 'max_win' => 5000],
                    ['name' => 'Big Bass Bonanza', 'rtp' => 96.71, 'volatility' => 'Média', 'max_win' => 2100],
                ],
            ],
        ];

        foreach ($providers as $providerData) {
            $provider = Provider::updateOrCreate(
                ['slug' => Str::slug($providerData['name'])],
                [
                    'name' => $providerData['name'],
                    'description' => $providerData['description'],
                    'logo_url' => $providerData['logo_url'],
                ]
            );

            foreach ($providerData['games'] as $game) {
                SlotGame::updateOrCreate(
                    ['slug' => Str::slug($providerData['name'] . ' ' . $game['name'])],
                    [
                        'provider_id' => $provider->id,
                        'name' => $game['name'],
                        'rtp' => $game['rtp'],
                        'volatility' => $game['volatility'],
                        'max_win' => $game['max_win'],
                        'is_active' => true,
                    ]
                );
            }

            $provider->update([
                'games_count' => $provider->slotGames()->count(),
                'avg_rtp' => $provider->slotGames()->avg('rtp'),
            ]);
        }
    }
}
