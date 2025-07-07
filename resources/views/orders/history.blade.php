<x-app-layout title="Order History">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        @forelse ($orders as $order)
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-blue-200 p-6 hover:shadow-lg transition-shadow duration-200">
                                <!-- Order Header -->
                                <div class="flex justify-between items-start mb-4 pb-3 border-b border-blue-200">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <h3 class="text-lg font-bold text-gray-900">Order #{{ $order->id }}</h3>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                @if($order->status === 'completed') bg-green-100 text-green-800
                                                @elseif($order->status === 'preparing') bg-yellow-100 text-yellow-800
                                                @elseif($order->status === 'pending') bg-blue-100 text-blue-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-gray-600">
                                            <p>
                                                <span class="font-medium">Ordered:</span>
                                                {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                                            </p>
                                            @if($order->full_name)
                                                <p>
                                                    <span class="font-medium">Delivery to:</span>
                                                    {{ $order->full_name }}
                                                </p>
                                            @endif
                                            @if($order->phone)
                                                <p>
                                                    <span class="font-medium">Phone:</span>
                                                    {{ $order->phone }}
                                                </p>
                                            @endif
                                            @if($order->total_price ?? false)
                                                <p>
                                                    <span class="font-medium">Total:</span>
                                                    <span class="font-bold text-green-600">${{ number_format($order->total_price, 2) }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        @if($order->status === 'pending')
                                            <div class="text-xs text-gray-500">
                                                <div class="flex items-center">
                                                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-1 animate-pulse"></div>
                                                    Processing...
                                                </div>
                                            </div>
                                        @elseif($order->status === 'preparing')
                                            <div class="text-xs text-gray-500">
                                                <div class="flex items-center">
                                                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-1 animate-pulse"></div>
                                                    Being prepared
                                                </div>
                                            </div>
                                        @elseif($order->status === 'completed')
                                            <div class="text-xs text-green-600 font-medium">
                                                ✓ Delivered
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Delivery Address (if available) -->
                                @if($order->address_line1)
                                    <div class="bg-white rounded-lg border border-gray-200 p-4 mb-4">
                                        <h4 class="font-medium text-gray-900 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Delivery Address
                                        </h4>
                                        <div class="text-sm text-gray-600">
                                            <p>{{ $order->address_line1 }}</p>
                                            @if($order->address_line2)
                                                <p>{{ $order->address_line2 }}</p>
                                            @endif
                                            <p>{{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}</p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Order Items -->
                                <div class="space-y-3">
                                    <h4 class="font-medium text-gray-900 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                        Items Ordered ({{ $order->items->sum('quantity') }} items)
                                    </h4>
                                    <div class="grid gap-2">
                                        @foreach ($order->items as $item)
                                            <div class="flex justify-between items-center bg-white rounded-md p-3 border border-gray-200">
                                                <div class="flex items-center">
                                                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                                    <div>
                                                        <span class="font-medium text-gray-900">{{ $item->pizza->name }}</span>
                                                        @if($item->pizza->price ?? false)
                                                            <span class="text-sm text-gray-500 ml-2">${{ number_format($item->pizza->price, 2) }} each</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-500 mr-2">Qty:</span>
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $item->quantity }}
                                                    </span>
                                                    @if($item->pizza->price ?? false)
                                                        <span class="text-sm font-medium text-gray-900 ml-3">
                                                            ${{ number_format($item->pizza->price * $item->quantity, 2) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Order Actions -->
                                <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-200">
                                    <div class="text-sm text-gray-500">
                                        @if($order->updated_at != $order->created_at)
                                            Last updated: {{ $order->updated_at->format('M d, Y \a\t h:i A') }}
                                        @endif
                                    </div>
                                    <div class="flex space-x-2">
                                        @if($order->status === 'completed')
                                            <button class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-md hover:bg-green-200 transition-colors">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                </svg>
                                                Download Receipt
                                            </button>
                                        @endif
                                        <button class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-md hover:bg-blue-200 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            Reorder
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-gray-50 rounded-lg border border-gray-200 p-8 text-center">
                                <div class="text-gray-500">
                                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No orders found</h3>
                                    <p class="text-gray-500 mb-4">
                                        @if(request('status'))
                                            No {{ request('status') }} orders found.
                                        @else
                                            You haven't placed any orders yet.
                                        @endif
                                    </p>
                                    <a href="{{ route('pizzas.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Order Now
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
