<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <center>
                        <div class="mb-4">
                            {{ __('Create Product') }}
                        </div>
                        <form method="POST" action="{{ route('product.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="border-2 rounded-md p-2 w-full" required>
                            </div>
                            <div class="mb-4">
                                <label for="description">Description</label>
                                <input type="textarea" name="description" id="description" class="border-2 rounded-md p-2 w-full" required>
                            </div>
                            <x-primary-button>
                                {{ __('Create Product') }}
                            </x-primary-button>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>