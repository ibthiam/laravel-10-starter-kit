<a {{ $attributes->merge(['class' => 'text-blue-500 hover:text-white bg-gray-200 hover:bg-blue-500 inline-flex items-start px-2 py-2 border border-transparent rounded-md font-medium text-xs uppercase tracking-widest active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
