@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white/90 dark:bg-slate-950/60 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:border-sky-400 focus:ring-2 focus:ring-sky-400/40 shadow-sm transition']) }}>
