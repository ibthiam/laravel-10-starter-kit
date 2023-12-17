<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }} 
            <span class="mx-2 text-base text-gray-500">|</span> 
            <span class="text-gray-400 text-sm italic">{{ __('Back to :') }}</span> 
            <a href="{{ route('user.index') }}" class="text-blue-500 text-sm italic hover:underline underline-offset-4">{{ __('User Management') }}</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-message-error :messages="'warning'" :background="'yellow'" class="bg-yellow-200 border-yellow-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 me-4">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                </svg>
            </x-message-error>

            <div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg flex justify-center">
                <div class="max-w-4xl">
                    @include('users.partials.edit-form', ['method' => 'PATCH', 'data' => $user, 'show' => false])
                </div>
            </div>

            @can('user_delete')
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('users.partials.delete-form')
                    </div>
                </div>
            @endcan
        </div>
    </div>
</x-app-layout>
