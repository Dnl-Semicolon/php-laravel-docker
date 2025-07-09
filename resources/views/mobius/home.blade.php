<x-app-layout title="Home">
    <x-slot name="header">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
            Mobius
        </h1>
        <p class="text-xl md:text-2xl text-blue-100 mb-8">
            Smart Waste Bin System with AI-Based Sorting
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('features') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                Explore Features
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                Get In Touch
            </a>
        </div>
    </x-slot>

    <!-- Hero Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Revolutionizing Waste Management with AI
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Mobius combines cutting-edge AI technology with IoT sensors to create an intelligent waste sorting system that promotes sustainability and tracks user behavior for better environmental outcomes.
            </p>
        </div>

        <!-- Key Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-brain text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">AI-Powered Sorting</h3>
                <p class="text-gray-600">
                    YOLOv11 image recognition automatically identifies and sorts waste into appropriate categories with high accuracy.
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-qrcode text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">User Tracking</h3>
                <p class="text-gray-600">
                    QR code system identifies users and tracks their waste disposal habits to promote responsible behavior.
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-cloud text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Real-time Sync</h3>
                <p class="text-gray-600">
                    Firebase integration ensures all data is synchronized across mobile app and web dashboard in real-time.
                </p>
            </div>
        </div>

        <!-- Technology Stack -->
        <div class="bg-gray-100 rounded-lg p-8 mb-16">
            <h2 class="text-2xl font-bold text-center mb-8">Built with Modern Technology</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fab fa-raspberry-pi text-red-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium">Raspberry Pi 5</span>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-eye text-yellow-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium">YOLOv11</span>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fab fa-google text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium">Firebase</span>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fab fa-flutter text-cyan-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium">Flutter</span>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-8 text-center text-white">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Ready to Transform Waste Management?</h2>
            <p class="text-lg mb-6">
                Join us in creating a more sustainable future with intelligent waste sorting technology.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('about') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                    Learn More
                </a>
                <a href="{{ route('gallery') }}" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                    View Gallery
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
