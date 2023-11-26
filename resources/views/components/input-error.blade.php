@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'font-medium text-base text-red-500 bg-red-200 border-red-500 rounded p-1 my-2']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

