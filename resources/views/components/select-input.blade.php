@props(['disabled' => false, 'options', 'checked', 'nullable' => false])

@php
    $classes = ($disabled ?? false)
                ? 'border-gray-300 text-sm font-medium block w-full p-2.5 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-gray-200'
                : 'border-gray-300 text-sm block w-full p-2.5 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
@endphp

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!}>
    @if ($options)
        @if ($nullable)
            <option {{ $checked == null ? 'selected' : '' }} value="0">{{ __('NONE') }}</option>
        @endif

        @if(!is_array($options))
            @foreach ($options as $option)
                <option {{ $checked == $option->id ? 'selected' : '' }} value="{{ $option->id }}">{{ strtoupper($option->name) }}</option>
            @endforeach
        @else
            @foreach ($options as $option)
                <option {{ $checked == $option ? 'selected' : '' }} value="{{ $option }}">{{ strtoupper($option) }}</option>
            @endforeach
        @endif
    @endif
</select>
