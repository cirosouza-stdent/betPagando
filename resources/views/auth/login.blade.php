<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-slate-300" :status="session('status')" />

    <div class="mb-6">
        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Bem-vindo de volta</p>
        <h2 class="text-xl sm:text-2xl font-semibold mt-2">Entrar</h2>
        <p class="text-sm text-slate-600 dark:text-slate-400">Acompanhe provedores, RTPs e insights em tempo real.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="h-11 px-4" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 space-y-2">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="h-11 px-4"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 dark:border-slate-600 text-sky-400 shadow-sm focus:ring-sky-400 bg-white dark:bg-slate-950" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <a class="text-sm text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white" href="{{ route('register') }}">
                {{ __('Não tem conta? Cadastre-se') }}
            </a>
        </div>

        <x-primary-button class="mt-6 w-full h-11 text-sm">
            {{ __('Log in') }}
        </x-primary-button>
    </form>
</x-guest-layout>
