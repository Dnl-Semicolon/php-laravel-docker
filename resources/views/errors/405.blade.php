<x-app-layout title="Error">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="py-20 text-center">
                    <h1 class="text-4xl font-bold text-red-600 mb-4">405 – Method Not Allowed</h1>
                    <p class="text-gray-700 mb-6">You tried to access a page in a way that’s not allowed.</p>
                    <a href="{{ route('cart.show') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Go back to Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
