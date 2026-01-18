<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 dark:text-slate-100">MinhaBet</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400">Cadastre e acompanhe seus links de casas de aposta.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="grid lg:grid-cols-[420px,1fr] gap-8">
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold">Cadastrar casa</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Preencha os dados principais e salve.</p>
                </div>

                <x-auth-session-status class="mb-4 text-emerald-600 dark:text-emerald-400" :status="session('status')" />

                <form method="POST" action="{{ route('minha-bet.store') }}" class="space-y-4">
                    @csrf

                    <div class="space-y-2">
                        <x-input-label for="name" :value="__('Nome')" />
                        <x-text-input id="name" name="name" type="text" class="h-11 px-4" list="bet-name-suggestions" placeholder="Ex: BetXP" value="{{ old('name') }}" required />
                        <datalist id="bet-name-suggestions"></datalist>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="link" :value="__('Link')" />
                        <x-text-input id="link" name="link" type="url" class="h-11 px-4" placeholder="https://" value="{{ old('link') }}" required />
                        <x-input-error :messages="$errors->get('link')" class="mt-2" />
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-950/50 p-4 space-y-4">
                        <div>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">Saldo atual</p>
                            <div class="mt-2">
                                <x-text-input id="current_balance" name="current_balance" type="number" step="0.01" min="0" class="h-11 px-4" placeholder="0,00" value="{{ old('current_balance') }}" required />
                                <x-input-error :messages="$errors->get('current_balance')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="currency" :value="__('Moeda Principal')" />
                            <select id="currency" name="currency" class="mt-2 w-full h-11 rounded-xl border border-slate-300 dark:border-slate-700 bg-white/90 dark:bg-slate-950/60 text-slate-900 dark:text-slate-100 px-4">
                                @foreach(['BRL', 'USD', 'EUR', 'BTC'] as $currency)
                                    <option value="{{ $currency }}" @selected(old('currency', 'BRL') === $currency)>{{ $currency }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('currency')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600 dark:text-slate-400">Status</span>
                            <label class="inline-flex items-center gap-2 text-sm text-slate-700 dark:text-slate-200">
                                <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300 dark:border-slate-600 text-sky-500 focus:ring-sky-400" {{ old('is_active', true) ? 'checked' : '' }}>
                                Ativo
                            </label>
                        </div>
                    </div>

                    <x-primary-button class="w-full h-11 text-sm">
                        Salvar cadastro
                    </x-primary-button>
                </form>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/70 p-6 shadow-lg">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                        <div>
                            <h3 class="text-lg font-semibold">Casas cadastradas</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Gerencie status, saldos e links.</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-slate-500 dark:text-slate-400">
                                <tr class="border-b border-slate-200 dark:border-slate-800">
                                    <th class="py-3 pr-4">Nome</th>
                                    <th class="py-3 pr-4">Link</th>
                                    <th class="py-3 pr-4">Saldo</th>
                                    <th class="py-3 pr-4">Moeda</th>
                                    <th class="py-3 pr-4">Status</th>
                                    <th class="py-3 text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-700 dark:text-slate-200">
                                @forelse ($bets as $bet)
                                    <tr class="border-b border-slate-100 dark:border-slate-800/70">
                                        <td class="py-3 pr-4 font-medium">{{ $bet->name }}</td>
                                        <td class="py-3 pr-4">
                                            <a href="{{ $bet->link }}" target="_blank" class="text-sky-600 dark:text-sky-400 hover:underline">Abrir</a>
                                        </td>
                                        <td class="py-3 pr-4">{{ number_format($bet->current_balance, 2, ',', '.') }}</td>
                                        <td class="py-3 pr-4">{{ $bet->currency }}</td>
                                        <td class="py-3 pr-4">
                                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $bet->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300' : 'bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-300' }}">
                                                {{ $bet->is_active ? 'Ativo' : 'Desativado' }}
                                            </span>
                                        </td>
                                        <td class="py-3 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button type="button" class="text-xs text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white" data-edit-bet="{{ $bet->id }}">Editar</button>
                                                <form method="POST" action="{{ route('minha-bet.destroy', $bet) }}" onsubmit="return confirm('Deseja remover este cadastro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs text-rose-600 hover:text-rose-700">Excluir</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hidden" data-edit-row="{{ $bet->id }}">
                                        <td colspan="6" class="pb-4">
                                            <form method="POST" action="{{ route('minha-bet.update', $bet) }}" class="grid gap-3 sm:grid-cols-6 items-end bg-slate-50/80 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 rounded-xl p-4">
                                                @csrf
                                                @method('PUT')

                                                <div class="sm:col-span-2">
                                                    <x-input-label for="name-{{ $bet->id }}" :value="__('Nome')" />
                                                    <x-text-input id="name-{{ $bet->id }}" name="name" type="text" class="h-10 px-3 mt-2" value="{{ $bet->name }}" required />
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <x-input-label for="link-{{ $bet->id }}" :value="__('Link')" />
                                                    <x-text-input id="link-{{ $bet->id }}" name="link" type="url" class="h-10 px-3 mt-2" value="{{ $bet->link }}" required />
                                                </div>
                                                <div>
                                                    <x-input-label for="balance-{{ $bet->id }}" :value="__('Saldo')" />
                                                    <x-text-input id="balance-{{ $bet->id }}" name="current_balance" type="number" step="0.01" min="0" class="h-10 px-3 mt-2" value="{{ $bet->current_balance }}" required />
                                                </div>
                                                <div>
                                                    <x-input-label for="currency-{{ $bet->id }}" :value="__('Moeda')" />
                                                    <select id="currency-{{ $bet->id }}" name="currency" class="mt-2 w-full h-10 rounded-xl border border-slate-300 dark:border-slate-700 bg-white/90 dark:bg-slate-950/60 text-slate-900 dark:text-slate-100 px-3">
                                                        @foreach(['BRL', 'USD', 'EUR', 'BTC'] as $currency)
                                                            <option value="{{ $currency }}" @selected($bet->currency === $currency)>{{ $currency }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <x-input-label for="active-{{ $bet->id }}" :value="__('Status')" />
                                                    <select id="active-{{ $bet->id }}" name="is_active" class="mt-2 w-full h-10 rounded-xl border border-slate-300 dark:border-slate-700 bg-white/90 dark:bg-slate-950/60 text-slate-900 dark:text-slate-100 px-3">
                                                        <option value="1" @selected($bet->is_active)>Ativo</option>
                                                        <option value="0" @selected(! $bet->is_active)>Desativado</option>
                                                    </select>
                                                </div>
                                                <div class="sm:col-span-6 flex justify-end gap-2">
                                                    <button type="button" class="text-xs text-slate-500 dark:text-slate-300" data-cancel-edit="{{ $bet->id }}">Cancelar</button>
                                                    <x-primary-button class="h-10 text-xs">Salvar</x-primary-button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-6 text-center text-slate-500 dark:text-slate-400">
                                            Nenhum cadastro ainda.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const nameInput = document.getElementById('name');
        const suggestions = document.getElementById('bet-name-suggestions');
        let searchTimeout = null;

        const fetchSuggestions = (term) => {
            fetch(`{{ route('minha-bet.search') }}?term=${encodeURIComponent(term)}`)
                .then((response) => response.json())
                .then((data) => {
                    suggestions.innerHTML = '';
                    data.forEach((name) => {
                        const option = document.createElement('option');
                        option.value = name;
                        suggestions.appendChild(option);
                    });
                })
                .catch(() => {
                    suggestions.innerHTML = '';
                });
        };

        if (nameInput) {
            nameInput.addEventListener('input', (event) => {
                const term = event.target.value.trim();
                clearTimeout(searchTimeout);

                if (term.length < 2) {
                    suggestions.innerHTML = '';
                    return;
                }

                searchTimeout = setTimeout(() => fetchSuggestions(term), 250);
            });
        }

        document.querySelectorAll('[data-edit-bet]').forEach((button) => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-edit-bet');
                const row = document.querySelector(`[data-edit-row="${id}"]`);
                if (row) {
                    row.classList.toggle('hidden');
                }
            });
        });

        document.querySelectorAll('[data-cancel-edit]').forEach((button) => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-cancel-edit');
                const row = document.querySelector(`[data-edit-row="${id}"]`);
                if (row) {
                    row.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
