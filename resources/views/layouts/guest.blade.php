<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
        <div class="min-h-screen relative overflow-hidden">
            <div class="absolute -top-40 -left-40 h-80 w-80 rounded-full bg-sky-500/20 blur-3xl"></div>
            <div class="absolute -bottom-40 -right-40 h-96 w-96 rounded-full bg-indigo-500/20 blur-3xl"></div>

            <div class="relative flex min-h-screen items-center justify-center px-4 py-10 sm:px-6 lg:px-10">
                <div class="w-full max-w-6xl grid items-center gap-10 lg:grid-cols-2">
                    <div class="order-2 lg:order-1">
                        <div class="flex items-center gap-3 mb-8">
                            <img src="/images/brand-mark.svg" alt="Marca betPagando" class="h-12 w-12" />
                            <div>
                                <p class="text-lg font-semibold">betPagando</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Análises inteligentes de RTP</p>
                            </div>
                        </div>

                        <div class="w-full max-w-md">
                            <div class="mb-6">
                                <h1 class="text-2xl sm:text-3xl font-semibold">Acesse sua conta</h1>
                                <p class="text-slate-600 dark:text-slate-400">Gerencie o catálogo e acompanhe a performance dos provedores.</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 dark:border-slate-800/80 bg-white/80 dark:bg-slate-900/70 p-6 sm:p-8 shadow-2xl backdrop-blur">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>

                    <div class="order-1 lg:order-2 hidden lg:flex items-center justify-center">
                        <div class="max-w-lg text-center rounded-3xl border border-slate-200 dark:border-slate-800/80 bg-white/70 dark:bg-slate-900/40 p-8 shadow-2xl">
                            <img src="/images/auth-illustration.svg" alt="Ilustração de análise" class="w-full" />
                            <h2 class="mt-6 text-xl font-semibold">Dashboard intuitiva</h2>
                            <p class="text-slate-600 dark:text-slate-400">Compare RTPs, volatilidade e tendências com gráficos objetivos.</p>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" data-theme-toggle class="fixed bottom-6 right-6 z-50 inline-flex items-center justify-center h-12 w-12 rounded-full border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900/90 text-slate-700 dark:text-slate-200 shadow-lg hover:-translate-y-0.5 transition">
                <svg data-theme-icon="light" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="4" />
                    <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                </svg>
                <svg data-theme-icon="dark" class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                </svg>
            </button>
        </div>
    </body>
</html>
