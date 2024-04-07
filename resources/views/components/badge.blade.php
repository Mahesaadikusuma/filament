@props(['textColor', 'bgColor'])

@php
    $textColor = match ($textColor) {
        'gray' => 'text-gray-200',
        'blue' => 'text-blue-200',
        'red' => 'text-red-200',
        'yellow' => 'text-yellow-200',
        default => 'text-gray-200',
    };

    $bgColor = match ($bgColor) {
        'gray' => 'bg-gray-500',
        'blue' => 'bg-blue-500',
        'red' => 'bg-red-500',
        'yellow' => 'bg-yellow-500',
        default => 'bg-gray-500',
    };
@endphp

<a href="#" class="{{ $textColor }} {{ $bgColor }} rounded-xl px-3 py-1 text-base">
    {{ $slot }}
</a>
