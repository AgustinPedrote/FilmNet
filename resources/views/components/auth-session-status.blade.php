@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-base text-green-500 bg-green-200 border-green-500 rounded p-1 my-2']) }}>
        {{ $status }}
    </div>
@endif

