<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>betPagando | Catálogo de Slots</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
        <div class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
            <nav class="sticky top-0 z-30 border-b border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-950/90 backdrop-blur">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-4 py-4 sm:flex-row sm:items-center sm:justify-between">
                        <a href="/" class="flex items-center gap-3">
                            <img src="/images/brand-mark.svg" alt="Marca betPagando" class="h-10 w-10" />
                            <div>
                                <p class="text-lg font-semibold">betPagando</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Catálogo inteligente de slots</p>
                            </div>
                        </a>
                        <div class="flex flex-wrap items-center gap-3">
                            <a href="/login" class="px-4 py-2 rounded-full border border-slate-200 dark:border-slate-700 text-sm text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white hover:border-slate-300 dark:hover:border-slate-600 transition">Entrar</a>
                            <a href="/register" class="px-4 py-2 rounded-full bg-sky-500 text-sm font-semibold text-slate-950 hover:bg-sky-400 transition shadow-lg shadow-sky-500/20">Criar conta</a>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="pb-12">
                {{ $slot }}
            </main>

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
