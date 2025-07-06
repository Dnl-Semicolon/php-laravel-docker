<x-app-layout title="All Orders">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Orders') }}
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
                                            Customer: <span class="font-medium">{{ $order->user->name }}</span>
                                            <span class="text-gray-400">(ID: {{ $order->user->id }})</span>
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            Ordered on: <span class="font-medium">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</span>
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium mb-2
                                            @if($order->status === 'completed') bg-green-100 text-green-800
                                            @elseif($order->status === 'preparing') bg-yellow-100 text-yellow-800
                                            @elseif($order->status === 'pending') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Status Update Form -->
                                <div class="bg-white rounded-lg border border-gray-200 p-4 mb-4">
                                    <h4 class="font-medium text-gray-900 mb-3">Update Order Status:</h4>
                                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="flex items-center gap-3">
                                        @csrf
                                        <select name="status" class="border border-gray-300 rounded-md py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="pending" @selected($order->status === 'pending')>Pending</option>
                                            <option value="preparing" @selected($order->status === 'preparing')>Preparing</option>
                                            <option value="completed" @selected($order->status === 'completed')>Completed</option>
                                            <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                                        </select>
                                        <button
{{--                                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm text-gray-600 font-semibold uppercase tracking-widest rounded-md bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none"--}}
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            type="submit">
                                            Update Status
                                        </button>
                                    </form>
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
                                    <p class="text-gray-500">No orders have been placed yet.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
