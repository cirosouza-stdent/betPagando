<x-guest-layout>
    <div class="mb-4 text-sm text-slate-600 dark:text-slate-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="h-11 px-4"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <x-primary-button class="h-11 text-sm">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
