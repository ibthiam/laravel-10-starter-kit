<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($roles->count())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="grid grid-cols-1 gap-x-6  sm:grid-cols-6">
                            <header class="sm:col-span-4">
                                <h2 class="text-lg font-semibold text-gray-900">
                                    {{ __('List of Roles') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __("Manage all platform roles according to your accreditations.") }}
                                </p>
                            </header>

                            @can('role_create')
                                <div class="sm:col-span-2 px-6 flex items-center justify-end">
                                    <x-normal-icon-button href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 me-2">
                                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                                        </svg>

                                        {{ __('New Role') }}
                                    </x-normal-icon-button>
                                </div>
                            @endcan
                        </div>

                        <div class="relative overflow-x-auto sm:rounded-lg mt-10 border-2 border-gray-100">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="">
                                    <th scope="col" class="p-4"></th>
                                    <th scope="col" class="px-6 py-4">
                                        {{ __('Name') }}
                                    </th>
                                    <th scope="col" class="px-6 py-4">
                                        {{ __('Permissions Counter') }}
                                    </th>
                                    <th scope="col" class="px-6 py-4">
                                        {{ __('Created At') }}
                                    </th>
                                    <th scope="col" class="px-6 py-4">
                                        {{ __('Updated At') }}
                                    </th>
                                    <th scope="col" class="px-6 py-4">
                                        Action
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($roles as $role)
                                    <tr class="bg-white border-y hover:bg-gray-50">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input disabled id="checkbox-table-search-{{ $role->id }}" type="checkbox" value="{{ $role->id }}" class="w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                                <label for="checkbox-table-search-{{ $role->id }}" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap" title="{{ strtolower($role->name) }}">
                                            <a href="#" class="text-blue-600 hover:underline">{{ strtolower(\Illuminate\Support\Str::limit($role->name, 25) ) }}</a>
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $role->name != 'super_admin' ? count($role->permissions) : __('ALL') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @isset($role->created_at)
                                                @datetime($role->created_at)
                                            @endisset
                                        </td>
                                        <td class="px-6 py-4">
                                            @isset($role->udpated_at)
                                                @datetime($role->udpated_at)
                                            @endisset
                                        </td>

                                        <td class="px-6 py-4">
                                            @can('role_edit')
                                                <a href="#" class="text-gray-500 hover:text-white bg-gray-200 hover:bg-green-500 focus:ring-2 focus:ring-offset-1 focus:outline-none focus:ring-green-700 font-medium rounded-lg text-sm p-1.5 text-center inline-flex items-center me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                                    </svg>
                                                </a>
                                            @endcan

                                            @can('role_delete')
                                                <form action="#" method="POST" class="inline-flex items-center">
                                                    @csrf
                                                    {{--@method('DELETE')--}}
                                                    @method('GET')

                                                    <button type="submit" class="text-red-500 hover:text-white bg-gray-200 hover:bg-red-500 focus:ring-2 focus:ring-offset-1 focus:outline-none focus:ring-red-700 font-medium rounded-lg text-sm p-1.5 text-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $roles->links() }}
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center">
                    <div class="p-6 text-gray-900">
                        {{ __("No Roles!") }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
