<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete User') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once this user is deleted, all resources and data that are dependent on it will be permanently deleted.') }}
        </p>
    </header>

    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('DELETE')

        <x-danger-icon-button>
            {{ __('Delete this user') }}
        </x-danger-icon-button>
    </form>
</section>
