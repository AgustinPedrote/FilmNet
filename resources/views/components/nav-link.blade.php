@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-yellow-400 text-lg font-bold leading-5 text-white focus:outline-none focus:border-blue-500 transition duration-150 ease-in-out hover:text-yellow-400'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-yellow-400 text-lg font-bold leading-5 text-white focus:outline-none focus:border-blue-500 transition duration-150 ease-in-out hover:text-yellow-400';
@endphp



<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

{{-- @php
$classes = 'inline-flex items-center px-1 pt-1 border-b-2 border-yellow-400 text-lg font-bold leading-5 text-white hover:text-white hover:border-black focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out';
@endphp --}}



