<x-app-layout title="Pizzas">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pizza List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($pizzas as $pizza)
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-6 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                                <!-- Pizza Image -->
                                <div class="mb-4">
                                    <img
                                        src="{{ $pizza->image ? asset('storage/' . $pizza->image) : asset('images/pizza-placeholder.webp') }}"
                                        alt="{{ $pizza->name }}"
                                        class="w-full h-48 object-cover rounded-lg shadow-sm"
                                        onerror="this.src='{{ asset('images/pizza-placeholder.jpg') }}'"
                                    >
                                </div>

                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $pizza->name }}</h3>
                                    <span class="text-xl font-bold text-green-600">RM{{ $pizza->price }}</span>
                                </div>

                                @auth
                                    <form action="{{ route('cart.add', $pizza->id) }}" method="POST" class="mt-4">
                                        @csrf
                                        <button
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                            type="submit">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <div class="mt-4 text-center">
                                        <span class="text-gray-500 text-sm">Login to purchase</span>
                                    </div>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
