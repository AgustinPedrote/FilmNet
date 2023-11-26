@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'font-medium text-base text-green-500 bg-green-200 border-green-500 rounded p-1 my-2']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

