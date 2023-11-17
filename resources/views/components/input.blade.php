@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'bg-gray-100 focus:outline-none focus:border-none focus:ring-0 outline-none border-none text-xs text-gray-800 placeholder:text-gray-400',
]) !!}>


{{-- border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm --}}
