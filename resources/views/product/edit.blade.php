<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <center>
                        <div class="mb-4">
                            {{ __('Edit Product') }}
                        </div>
                        <form method="POST" action="/product/{{ $products->id }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name"
                                    class="border-2 rounded-md p-2 w-full" value="{{ $products->name }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description"
                                    class="border-2 rounded-md p-2 w-full" value="{{ $products->description }}"required>
                            </div>
                            <x-secondary-button>
                                <a href="{{ route('product.show') }}">
                                    {{ __('Cancel') }}
                                </a>
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Edit Product') }}
                            </x-primary-button>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>