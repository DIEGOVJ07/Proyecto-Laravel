@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-cb-green text-sm font-medium leading-5 text-white focus:outline-none focus:border-emerald-400 transition duration-150 ease-in-out shadow-sm'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-cb-green/50 focus:outline-none focus:text-white focus:border-cb-green/50 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
