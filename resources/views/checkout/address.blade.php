<x-app-layout title="Checkout">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📦 Shipping Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Indicator -->
            <div class="mb-8">
                <div class="flex items-center justify-center">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                                ✓
                            </div>
                            <span class="ml-2 text-sm font-medium text-green-600">Cart</span>
                        </div>
                        <div class="w-8 h-1 bg-green-600 rounded"></div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                                2
                            </div>
                            <span class="ml-2 text-sm font-medium text-blue-600">Shipping</span>
                        </div>
                        <div class="w-8 h-1 bg-gray-300 rounded"></div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-medium">
                                3
                            </div>
                            <span class="ml-2 text-sm font-medium text-gray-600">Payment</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8">
                    <!-- Header -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Delivery Information</h3>
                        <p class="text-gray-600">Please provide your delivery address details</p>
                    </div>

                    <form method="POST" action="{{ route('checkout.processAddress') }}" class="space-y-6">
                        @csrf

                        <!-- Personal Information Section -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Personal Information
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="full_name"
                                           value="{{ old('full_name', $address['full_name'] ?? '') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                           placeholder="Enter your full name"
                                           required>
                                    @error('full_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" name="phone"
                                           value="{{ old('phone', $address['phone'] ?? '') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                           placeholder="e.g., 012-345-6789"
                                           required>
                                    @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Address Information Section -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Delivery Address
                            </h4>

                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Address Line 1 <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="address_line1"
                                           value="{{ old('address_line1', $address['address_line1'] ?? '') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                           placeholder="Street address, building number"
                                           required>
                                    @error('address_line1')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Address Line 2 <span class="text-gray-400">(Optional)</span>
                                    </label>
                                    <input type="text" name="address_line2"
                                           value="{{ old('address_line2', $address['address_line2'] ?? '') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                           placeholder="Apartment, suite, unit, etc.">
                                    @error('address_line2')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            City <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="city"
                                               value="{{ old('city', $address['city'] ?? '') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                               placeholder="City name"
                                               required>
                                        @error('city')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    @php
                                        $selectedState = old('state', $address['state'] ?? '');
                                    @endphp

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            State <span class="text-red-500">*</span>
                                        </label>
                                        <select name="state"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                required>
                                            <option value="" {{ $selectedState == '' ? 'selected' : '' }}>Select State</option>
                                            <option value="Johor" {{ $selectedState == 'Johor' ? 'selected' : '' }}>Johor</option>
                                            <option value="Kedah" {{ $selectedState == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                                            <option value="Kelantan" {{ $selectedState == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                                            <option value="Kuala Lumpur" {{ $selectedState == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
                                            <option value="Labuan" {{ $selectedState == 'Labuan' ? 'selected' : '' }}>Labuan</option>
                                            <option value="Melaka" {{ $selectedState == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                                            <option value="Negeri Sembilan" {{ $selectedState == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                                            <option value="Pahang" {{ $selectedState == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                                            <option value="Perak" {{ $selectedState == 'Perak' ? 'selected' : '' }}>Perak</option>
                                            <option value="Perlis" {{ $selectedState == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                                            <option value="Pulau Pinang" {{ $selectedState == 'Pulau Pinang' ? 'selected' : '' }}>Pulau Pinang</option>
                                            <option value="Putrajaya" {{ $selectedState == 'Putrajaya' ? 'selected' : '' }}>Putrajaya</option>
                                            <option value="Sabah" {{ $selectedState == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                                            <option value="Sarawak" {{ $selectedState == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                                            <option value="Selangor" {{ $selectedState == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                                            <option value="Terengganu" {{ $selectedState == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                                        </select>
                                        @error('state')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Postal Code <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="postal_code"
                                               value="{{ old('postal_code', $address['postal_code'] ?? '') }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                               placeholder="12345"
                                               maxlength="5"
                                               required>
                                        @error('postal_code')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Instructions (Optional) -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z"></path>
                                </svg>
                                Delivery Instructions
                            </h4>
                            <textarea name="delivery_instructions"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                      rows="3"
                                      placeholder="Any special instructions for delivery? (e.g., building access, preferred delivery time)"></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-between pt-6 border-t border-gray-200">
                            <a href="{{ route('cart.show') }}"
                               class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Back to Cart
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center justify-center px-8 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Proceed to Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>

{{--            <!-- Security Notice -->--}}
{{--            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">--}}
{{--                <div class="flex items-center">--}}
{{--                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>--}}
{{--                    </svg>--}}
{{--                    <p class="text-sm text-blue-800">--}}
{{--                        <strong>Secure Checkout:</strong> Your personal information is protected with SSL encryption.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</x-app-layout>
