<section>
    <div>
        <div class="grid grid-cols-1 gap-x-6 sm:grid-cols-6">
            <header class="sm:col-span-4">
                <h2 class="text-lg font-semibold text-gray-900">
                    {{ __("User's Information") }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    @if(!request()->routeIs('user.show'))
                        {{ __("Enter the user's information in the dedicated fields.") }}
                    @else
                        {{ __("View user information in dedicated fields.") }}
                    @endif
                </p>
            </header>

            @if($show)
                <div class="sm:col-span-2 pl-6 flex items-center justify-end">
                    <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="text-green-500 hover:text-white bg-gray-200 hover:bg-green-500 focus:ring-2 focus:ring-offset-1 focus:outline-none focus:ring-red-700 font-medium rounded-lg text-sm p-1.5 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>

        <form method="post" action="{{ isset($user) ? route('user.update', ['user' => $user->id]) : route('user.store') }}" class="mt-6 space-y-8">
            @csrf
            @method($method)

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input :disabled="$show" id="name" name="name" type="text" class="mt-1 block w-full" :value="isset($user) ? $user->name : old('name')" autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input :disabled="$show" id="email" name="email" type="email" class="mt-1 block w-full" :value="isset($user) ? $user->email : old('email')" autocomplete="email" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <fieldset>
                <x-input-label for="role" :value="__('Role')" />
                <div class="mt-2">
                    <x-select-input :disabled="$show" id="role" name="role" :options="$roles" :checked="isset($user->roles) ? $user->roles[0]->id : old('role')"/>
                    <x-input-help>{{ __("An empty list means you don't have any roles yet. You have to create some.") }}</x-input-help>
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>
            </fieldset>

            @if(!isset($user))
                <div>
                    <x-input-label for="initialPass" :value="__('Initial Password')" />
                    <x-text-input :disabled="true" id="initialPass" name="text" type="text" class="mt-1 block w-full text-base text-gray-800" :value="'P@ssW0rd123'" />
                </div>
            @endif

            @isset($user)
                <div>
                    <x-input-label for="created_at" :value="__('Created At')" />
                    <x-text-input :disabled="true" id="created_at" type="text" class="mt-1 block w-full" :value="$user->created_at" />
                </div>

                <div>
                    <x-input-label for="updated_at" :value="__('Updated At')" />
                    <x-text-input :disabled="true" id="updated_at" type="text" class="mt-1 block w-full" :value="$user->updated_at" />
                </div>
            @endisset

            @if(!$show)
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="reset" class="text-sm font-semibold leading-6 text-gray-900">{{ __('Cancel') }}</button>
                    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                        </svg>
                        {{ isset($user) ? __("Update") :  __("Save")}}
                    </button>
                </div>
            @endif
        </form>
    </div>
</section>
