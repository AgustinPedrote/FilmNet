@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-blue-500 focus:border-blue-600 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
