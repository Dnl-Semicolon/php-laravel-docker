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
                                <div class="flex justify-between items-center mb-4 pb-3 border-b border-blue-200">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">Order #{{ $order->id }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            Ordered on: <span class="font-medium">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</span>
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                            @if($order->status === 'completed') bg-green-100 text-green-800
                                            @elseif($order->status === 'preparing') bg-yellow-100 text-yellow-800
                                            @elseif($order->status === 'pending') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Order Items -->
                                <div class="space-y-3">
                                    <h4 class="font-medium text-gray-900 mb-3">Items Ordered:</h4>
                                    <div class="grid gap-2">
                                        @foreach ($order->items as $item)
                                            <div class="flex justify-between items-center bg-white rounded-md p-3 border border-gray-200">
                                                <div class="flex items-center">
                                                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                                    <span class="font-medium text-gray-900">{{ $item->pizza->name }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-500 mr-2">Qty:</span>
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $item->quantity }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-gray-50 rounded-lg border border-gray-200 p-8 text-center">
                                <div class="text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No orders found</h3>
                                    <p class="text-gray-500">You haven't placed any orders yet.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
