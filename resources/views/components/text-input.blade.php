@props(['disabled' => false])

@php
    $classes = ($disabled ?? false)
                ? 'border-gray-300 bg-gray-200 text-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm '
                : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!}>
