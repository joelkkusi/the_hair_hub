<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <center>
                        <div class="mb-4">
                            {{ __('Edit User') }}
                        </div>
                        <form method="POST" action="/admin/{{ $users->id }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name"
                                    class="border-2 rounded-md p-2 w-full" value="{{ $users->name }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="border-2 rounded-md p-2 w-full" value="{{ $users->email }}"required>
                            </div>
                            <div class="mb-4">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone"
                                    class="border-2 rounded-md p-2 w-full" value="{{ $users->phone }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="role">Usertype</label>
                                <select name="usertype" class="border-2 rounded-md p-2 w-full" required>
                                    <option disabled value="{{ $users->usertype }}">Currently: {{ $users->usertype }}</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Customer">Customer</option>
                                </select>
                            </div>
                            <x-secondary-button>
                                <a href="{{ route('admin.show') }}">
                                    {{ __('Cancel') }}
                                </a>
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Edit User') }}
                            </x-primary-button>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>