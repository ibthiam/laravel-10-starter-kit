@props(['messages', 'background' => 'green'])


@if(session()->has($messages))
    <div 
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"

        {!! $attributes->merge(['class' => 'overflow-hidden shadow-sm sm:rounded-lg mb-6 border-2']) !!}>
        <div class="p-4 text-gray-600 font-medium inline-flex items-center">
            {{ $slot }}
            {{ session()->get($messages) }}
        </div>
    </div>
@endif
