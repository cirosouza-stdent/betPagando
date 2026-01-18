@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-sky-400 text-start text-base font-medium text-sky-700 dark:text-sky-200 bg-slate-100 dark:bg-slate-900 focus:outline-none focus:text-slate-900 dark:focus:text-white focus:bg-slate-100 dark:focus:bg-slate-800 focus:border-sky-300 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 hover:border-slate-300 dark:hover:border-slate-600 focus:outline-none focus:text-slate-900 dark:focus:text-white focus:bg-slate-100 dark:focus:bg-slate-800 focus:border-slate-300 dark:focus:border-slate-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
