<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <h2 class="text-2xl font-semibold">Dashboard</h2>
                <p class="text-slate-600 dark:text-slate-400">Resumo dos provedores e desempenho dos jogos.</p>
            </div>
            <img src="/images/dashboard-hero.svg" alt="Gráfico do dashboard" class="w-full max-w-sm" />
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 mt-8">
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg">
                <p class="text-sm text-slate-600 dark:text-slate-400">Provedores</p>
                <p class="text-3xl font-semibold">{{ $stats['providers'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg">
                <p class="text-sm text-slate-600 dark:text-slate-400">Jogos ativos</p>
                <p class="text-3xl font-semibold">{{ $stats['games'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg">
                <p class="text-sm text-slate-600 dark:text-slate-400">RTP médio geral</p>
                <p class="text-3xl font-semibold">{{ number_format($stats['avg_rtp'] ?? 0, 2, ',', '.') }}%</p>
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-3 mt-10">
            <div class="lg:col-span-2 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Top jogos por RTP</h3>
                    <span class="text-sm text-slate-600 dark:text-slate-400">Última atualização</span>
                </div>
                <div class="space-y-4">
                    @forelse ($topGames as $game)
                        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-950/60 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-semibold">{{ $game->name }}</p>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">{{ $game->provider->name }}</p>
                                </div>
                                <span class="rounded-full bg-emerald-500/15 px-3 py-1 text-sm text-emerald-600 dark:text-emerald-300">{{ number_format($game->rtp, 2, ',', '.') }}%</span>
                            </div>
                            <div class="mt-3 h-2 rounded-full bg-slate-200 dark:bg-slate-800">
                                <div class="h-2 rounded-full bg-sky-400" style="width: {{ min(100, max(10, ($game->rtp - 80) * 5)) }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-600 dark:text-slate-400">Nenhum jogo cadastrado.</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Resumo por provedor</h3>
                <div class="space-y-4">
                    @foreach ($providers as $provider)
                        @php
                            $avg = $provider->slotGames->avg('rtp') ?? 0;
                        @endphp
                        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-950/60 p-4">
                            <div class="flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    @if ($provider->logo_url)
                                        <img src="{{ $provider->logo_url }}" alt="Logo {{ $provider->name }}" class="h-10 w-auto" />
                                    @endif
                                    <p class="font-semibold">{{ $provider->name }}</p>
                                </div>
                                <span class="text-sm text-slate-600 dark:text-slate-400">{{ $provider->slotGames->count() }} jogos</span>
                            </div>
                            <div class="mt-3 flex items-center justify-between text-sm text-slate-600 dark:text-slate-300">
                                <span>RTP médio</span>
                                <span>{{ number_format($avg, 2, ',', '.') }}%</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-slate-200 dark:bg-slate-800">
                                <div class="h-2 rounded-full bg-emerald-400" style="width: {{ min(100, max(10, ($avg - 80) * 5)) }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
