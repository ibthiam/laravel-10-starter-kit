@props(['disabled' => false, 'options', 'checked', 'name'])

@php
    $classes = ($disabled ?? false)
                ? 'h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600 border-gray-300 bg-gray-200 text-gray-600'
                : 'h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600';
@endphp

@if ($options)
    <div class="mt-6 space-y-6">
        @foreach ((array) $options as $key => $option)
            <div class="flex items-center gap-x-3">
                <input {{ $disabled ? 'disabled' : '' }} name="{{ $name }}"  id="push-{{ $key }}" value="{{ $key }}" type="radio" {!! $attributes->merge(['class' => $classes]) !!} {{ $checked == $key ? 'checked' : '' }}>
                <label for="push-{{ $key }}" class="block text-base font-medium leading-6 text-gray-900">{{ $option }}</label>
            </div>
        @endforeach
    </div>
@endif