<x-public-layout>
    <header class="pt-10 pb-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-semibold">Catálogo de Slots - betPagando</h1>
                    <p class="mt-2 text-slate-600 dark:text-slate-400">Visão geral dos principais provedores e RTPs para análise rápida.</p>
                </div>
                <img src="/images/catalog-hero.svg" alt="Ilustração do catálogo" class="w-full max-w-xl rounded-3xl border border-slate-200 dark:border-slate-800" />
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg">
                <p class="text-sm text-slate-600 dark:text-slate-400">Provedores</p>
                <p class="text-3xl font-semibold">{{ $globalStats['providers'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg">
                <p class="text-sm text-slate-600 dark:text-slate-400">Jogos ativos</p>
                <p class="text-3xl font-semibold">{{ $globalStats['games'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg">
                <p class="text-sm text-slate-600 dark:text-slate-400">RTP médio geral</p>
                <p class="text-3xl font-semibold">{{ number_format($globalStats['avg_rtp'] ?? 0, 2, ',', '.') }}%</p>
            </div>
        </section>

        <h3 class="mt-10 text-lg font-semibold">Provedores</h3>
        <section class="mt-4 grid gap-6 lg:grid-cols-2">
            @forelse ($providers as $provider)
                <article class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg space-y-5">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            @if ($provider->logo_url)
                                <img src="{{ $provider->logo_url }}" alt="Logo {{ $provider->name }}" class="h-12 w-auto" />
                            @endif
                            <div>
                                <h2 class="text-lg font-semibold">{{ $provider->name }}</h2>
                                <span class="inline-flex items-center rounded-full border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950/40 px-3 py-1 text-xs text-slate-600 dark:text-slate-400">
                                    {{ $provider->slotGames->count() }} jogos
                                </span>
                            </div>
                        </div>
                        <span class="inline-flex items-center rounded-full border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950/40 px-3 py-1 text-xs text-slate-600 dark:text-slate-400">
                            RTP médio {{ number_format($provider->stats['avg_rtp'] ?? 0, 2, ',', '.') }}%
                        </span>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3">
                        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-950/60 p-4 text-center">
                            <strong class="block text-lg">{{ number_format($provider->stats['min_rtp'] ?? 0, 2, ',', '.') }}%</strong>
                            <span class="text-xs text-slate-600 dark:text-slate-400">RTP mínimo</span>
                        </div>
                        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-950/60 p-4 text-center">
                            <strong class="block text-lg">{{ number_format($provider->stats['avg_rtp'] ?? 0, 2, ',', '.') }}%</strong>
                            <span class="text-xs text-slate-600 dark:text-slate-400">RTP médio</span>
                        </div>
                        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-950/60 p-4 text-center">
                            <strong class="block text-lg">{{ number_format($provider->stats['max_rtp'] ?? 0, 2, ',', '.') }}%</strong>
                            <span class="text-xs text-slate-600 dark:text-slate-400">RTP máximo</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @php
                            $min = $provider->stats['min_rtp'] ?? 0;
                            $avg = $provider->stats['avg_rtp'] ?? 0;
                            $max = $provider->stats['max_rtp'] ?? 0;
                            $scale = function ($rtp) {
                                $value = max(0, min(100, ($rtp - 80) * 5));
                                return $value;
                            };
                        @endphp
                        <div class="h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-2 rounded-full bg-sky-400" style="width: {{ $scale($min) }}%"></div>
                        </div>
                        <div class="h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-2 rounded-full bg-sky-400" style="width: {{ $scale($avg) }}%"></div>
                        </div>
                        <div class="h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-2 rounded-full bg-sky-400" style="width: {{ $scale($max) }}%"></div>
                        </div>
                    </div>

                    <div class="grid gap-3">
                        @forelse ($provider->slotGames as $game)
                            <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-950/60 p-4">
                                <h4 class="font-semibold">{{ $game->name }}</h4>
                                <div class="mt-2 flex flex-wrap gap-2 text-xs text-slate-600 dark:text-slate-400">
                                    <span class="rounded-full border border-emerald-300/60 dark:border-emerald-500/30 bg-emerald-500/10 px-2 py-0.5 text-emerald-700 dark:text-emerald-300">
                                        RTP {{ number_format($game->rtp, 2, ',', '.') }}%
                                    </span>
                                    @if ($game->volatility)
                                        <span>Volatilidade: {{ $game->volatility }}</span>
                                    @endif
                                    @if ($game->max_win)
                                        <span>Max win: {{ number_format($game->max_win, 0, ',', '.') }}x</span>
                                    @endif
                                    @if ($game->release_date)
                                        <span>Lançamento: {{ $game->release_date->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-950/60 p-4">
                                <p class="text-sm text-slate-600 dark:text-slate-400">Nenhum jogo cadastrado ainda.</p>
                            </div>
                        @endforelse
                    </div>
                </article>
            @empty
                <p class="text-slate-600 dark:text-slate-400">Nenhum provedor cadastrado.</p>
            @endforelse
        </section>
    </main>
</x-public-layout>
