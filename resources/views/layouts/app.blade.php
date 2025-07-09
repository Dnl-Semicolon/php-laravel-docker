<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mobius' }} - Smart Waste Bin System</title>
    <meta name="description" content="Mobius - AI-Based Smart Waste Bin System with automated sorting and user tracking for sustainable waste management.">
    <meta name="keywords" content="smart waste bin, AI sorting, waste management, sustainability, IoT, Raspberry Pi, YOLOv11">
    <meta name="author" content="Daniel Yee Kheng Tan">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $title ?? 'Mobius' }} - Smart Waste Bin System">
    <meta property="og:description" content="AI-Based Smart Waste Bin System with automated sorting and user tracking">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
<!-- Navigation -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-recycle text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Mobius</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    Home
                </x-nav-link>
                <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                    About
                </x-nav-link>
                <x-nav-link :href="route('features')" :active="request()->routeIs('features')">
                    Features
                </x-nav-link>
                <x-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">
                    Gallery
                </x-nav-link>
                <x-nav-link :href="route('impact')" :active="request()->routeIs('impact')">
                    Impact
                </x-nav-link>
                <x-nav-link :href="route('team')" :active="request()->routeIs('team')">
                    Team
                </x-nav-link>
                <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                    Contact
                </x-nav-link>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <x-mobile-nav-link :href="route('home')" :active="request()->routeIs('home')">
                Home
            </x-mobile-nav-link>
            <x-mobile-nav-link :href="route('about')" :active="request()->routeIs('about')">
                About
            </x-mobile-nav-link>
            <x-mobile-nav-link :href="route('features')" :active="request()->routeIs('features')">
                Features
            </x-mobile-nav-link>
            <x-mobile-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">
                Gallery
            </x-mobile-nav-link>
            <x-mobile-nav-link :href="route('impact')" :active="request()->routeIs('impact')">
                Impact
            </x-mobile-nav-link>
            <x-mobile-nav-link :href="route('team')" :active="request()->routeIs('team')">
                Team
            </x-mobile-nav-link>
            <x-mobile-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                Contact
            </x-mobile-nav-link>
        </div>
    </div>
</nav>

<!-- Header Section -->
@if(isset($header))
    <header class="gradient-bg hero-pattern">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                {{ $header }}
            </div>
        </div>
    </header>
@endif

<!-- Main Content -->
<main class="max-w-7xl mx-auto">
    {{ $slot }}
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-recycle text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold">Mobius</span>
                </div>
                <p class="text-gray-300">
                    AI-Based Smart Waste Bin System with automated sorting and user tracking for sustainable waste management.
                </p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-gray-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About</a></li>
                    <li><a href="{{ route('features') }}" class="hover:text-white transition-colors">Features</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                <div class="space-y-2 text-gray-300">
                    <p><i class="fas fa-user mr-2"></i>Daniel Yee Kheng Tan</p>
                    <p><i class="fas fa-envelope mr-2"></i>danielykt-pm23@student.tarc.edu.my</p>
                    <p><i class="fas fa-graduation-cap mr-2"></i>TAR UMT Penang, RSD Program</p>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
            <p>&copy; {{ date('Y') }} Mobius Smart Waste Bin System. Final Year Project by Daniel Yee Kheng Tan.</p>
        </div>
    </div>
</footer>

<!-- Mobile menu toggle script -->
<script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
    });
</script>
</body>
</html>
