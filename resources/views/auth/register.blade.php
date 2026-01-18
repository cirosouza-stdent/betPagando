<x-guest-layout>
    <div class="mb-6">
        <p class="text-xs uppercase tracking-[0.2em] text-slate-500 dark:text-slate-500">Novo por aqui</p>
        <h2 class="text-xl sm:text-2xl font-semibold mt-2">Criar conta</h2>
        <p class="text-sm text-slate-600 dark:text-slate-400">Configure seu acesso para acompanhar o catálogo.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="h-11 px-4" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Seu nome" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4 space-y-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="h-11 px-4" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 space-y-2">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="h-11 px-4"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 space-y-2">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="h-11 px-4"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white" href="{{ route('login') }}">
                {{ __('Já tem conta? Entrar') }}
            </a>
        </div>

        <div class="mt-6 flex items-center gap-3">
            <x-primary-button class="w-full h-11 text-sm">
                {{ __('Register') }}
            </x-primary-button>
            <button type="button" data-theme-toggle class="inline-flex items-center justify-center h-11 w-11 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900/90 text-slate-700 dark:text-slate-200 shadow-lg hover:-translate-y-0.5 transition">
                <svg data-theme-icon="light" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="4" />
                    <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                </svg>
                <svg data-theme-icon="dark" class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                </svg>
            </button>
        </div>
    </form>
</x-guest-layout>
