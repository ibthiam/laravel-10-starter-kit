<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-red-500 hover:text-white bg-gray-200 hover:bg-red-500 focus:ring-2 focus:ring-offset-1 focus:outline-none focus:ring-red-700 font-medium rounded-lg text-sm p-1.5 text-center']) }}>
    {{ $slot}}                                              
</button>