<x-app-layout title="Cart">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🛒 Your Cart
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    @if (count($cart) === 0)
                        <!-- Empty Cart State -->
                        <div class="text-center py-12">
                            <div class="mb-6">
                                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6.5M7 13L5.4 5M7 13h10m-10 0L5.4 5m0 0L3 3m4 10h10m-10 0L7 13"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Your cart is empty</h3>
                            <p class="text-gray-600 mb-6">Start adding some delicious pizzas to your cart!</p>
                            <a href="{{ route('pizzas.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Browse Pizzas
                            </a>
                        </div>
                    @else
                        <!-- Cart Items -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>

                            <div class="bg-gray-50 rounded-lg overflow-hidden">
                                <div class="hidden md:grid md:grid-cols-5 gap-4 p-4 bg-gray-100 text-sm font-medium text-gray-700">
                                    <div>Pizza</div>
                                    <div class="text-center">Quantity</div>
                                    <div class="text-right">Unit Price</div>
                                    <div class="text-right">Total</div>
                                    <div class="text-center">Actions</div>
                                </div>

                                @php $grandTotal = 0; @endphp
                                @foreach ($cart as $id => $item)
                                    @php
                                        $itemTotal = $item['price'] * $item['quantity'];
                                        $grandTotal += $itemTotal;
                                    @endphp
                                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 p-4 border-b border-gray-200 last:border-b-0">
                                        <!-- Pizza Name -->
                                        <div class="flex items-center md:col-span-1">
                                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                                🍕
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $item['name'] }}</h4>
                                                <p class="text-sm text-gray-600 md:hidden">
                                                    RM{{ number_format($item['price'], 2) }} each
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Quantity Controls -->
                                        <div class="flex items-center justify-center md:justify-center">
                                            <div class="flex items-center space-x-2">
                                                <form method="POST" action="{{ route('cart.update', $id) }}" class="inline-flex items-center bg-gray-200 rounded-lg">
                                                    @csrf
                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99"
                                                           class="w-16 py-2 px-3 bg-transparent text-center border-0 focus:ring-0 focus:outline-none font-medium">
                                                    <button type="submit" class="px-3 py-3 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 transition-colors text-sm">
                                                        Update
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Unit Price (Hidden on mobile) -->
                                        <div class="hidden md:flex items-center justify-end">
                                            <span class="text-gray-900 font-medium">RM{{ number_format($item['price'], 2) }}</span>
                                        </div>

                                        <!-- Total Price -->
                                        <div class="flex items-center justify-end">
                                            <span class="text-lg font-semibold text-gray-900">RM{{ number_format($itemTotal, 2) }}</span>
                                        </div>

                                        <!-- Remove Button -->
                                        <div class="flex items-center justify-center">
                                            <form method="POST" action="{{ route('cart.remove', $id) }}" class="inline-block">
                                                @csrf
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors"
                                                        onclick="return confirm('Are you sure you want to remove this item from your cart?')">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    <span class="hidden sm:inline">Remove</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Grand Total -->
                                <div class="bg-gray-100 p-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-900">Total Amount:</span>
                                        <span class="text-2xl font-bold text-green-600">RM{{ number_format($grandTotal, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-between">
                            <a href="{{ route('pizzas.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Continue Shopping
                            </a>

                            <div class="flex flex-col sm:flex-row gap-3">
                                <!-- Clear Cart Button -->
                                <form method="POST" action="{{ route('cart.clear') }}" class="inline-block">
                                    @csrf
                                    <button type="submit"
                                            class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors"
                                            onclick="return confirm('Are you sure you want to clear your entire cart?')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Clear Cart
                                    </button>
                                </form>

                                <!-- Checkout Button -->
{{--                                <form action="{{ route('checkout.address') }}" method="POST" class="inline-block">--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors shadow-md hover:shadow-lg">--}}
{{--                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>--}}
{{--                                        </svg>--}}
{{--                                        Proceed to Checkout--}}
{{--                                    </button>--}}
{{--                                </form>--}}
                                <!-- Checkout Button -->
                                <a href="{{ route('checkout.address') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
