@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-yellow-400 text-lg font-bold leading-5 text-white hover:text-yellow-400 focus:outline-none'
            : 'inline-flex items-center px-1 pt-1 text-lg font-bold leading-5 text-white hover:text-yellow-400 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>






