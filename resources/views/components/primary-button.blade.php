<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-sky-500 border border-transparent rounded-xl font-semibold text-xs text-slate-950 uppercase tracking-widest hover:bg-sky-400 focus:bg-sky-400 active:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-300/70 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-slate-950 transition ease-in-out duration-150 shadow-lg shadow-sky-500/20']) }}>
    {{ $slot }}
</button>
