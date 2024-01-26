@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full pl-3 pr-4 py-2 text-sm text-center font-medium text-gray-800 rounded-md bg-white hover:text-yellow-400 hover:bg-gray-400 focus:outline-none focus:bg-gray-400 transition duration-150 ease-in-out mb-2'
        : 'block w-full pl-3 pr-4 py-2 text-sm text-center font-medium text-gray-800 rounded-md bg-white hover:bg-yellow-400 focus:bg-gray-300 focus:outline-none transition duration-300 ease-in-out mb-2';
    @endphp

    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
