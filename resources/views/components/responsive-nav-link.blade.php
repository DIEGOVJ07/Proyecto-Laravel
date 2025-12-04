@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-cb-green text-start text-base font-medium text-white bg-cb-green/10 focus:outline-none focus:text-white focus:bg-cb-green/20 focus:border-emerald-400 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-300 hover:text-white hover:bg-cb-card hover:border-cb-green/50 focus:outline-none focus:text-white focus:bg-cb-card focus:border-cb-green/50 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
