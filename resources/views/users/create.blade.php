<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User') }} 
            <span class="mx-2 text-base text-gray-500">|</span> 
            <span class="text-gray-400 text-sm italic">{{ __('Back to :') }}</span> 
            <a href="{{ route('user.index') }}" class="text-blue-500 text-sm italic hover:underline underline-offset-4">{{ __('User Management') }}</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg flex justify-center">
                <div class="max-w-4xl">
                    @include('users.partials.edit-form', ['method' => 'POST', 'data' => '', 'show' => false])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
