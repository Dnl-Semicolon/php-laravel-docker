<!DOCTYPE html>
<html lang="en" style="background: #1a202c;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Pizza Shop Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'laravel-red': '#ef4444',
                        'laravel-dark-red': '#dc2626',
                        'laravel-purple': '#8b5cf6',
                        'laravel-dark-purple': '#7c3aed',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .pizza-slice {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .gradient-bg {
            /*background: linear-gradient(135deg, #7c3aed 0%, #dc2626 50%, #1f2937 100%);*/
            background: #1a202c;
        }
        .glass-effect {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
<div class="max-w-2xl w-full">
    <!-- Glass Card Container -->
    <div class="glass-effect rounded-3xl p-8 md:p-12 shadow-2xl">
        <!-- Animated Pizza Icon -->
        <div class="text-center mb-8">
            <div class="pizza-slice inline-block text-8xl md:text-9xl mb-4">
                🍕
            </div>
            <div class="text-6xl md:text-8xl font-bold text-white mb-2">
                404
            </div>
            <div class="text-xl md:text-2xl text-gray-200 font-medium">
                Oops! This page has gone missing
            </div>
        </div>

        <!-- Error Message -->
        <div class="text-center mb-8">
            <p class="text-gray-300 text-lg mb-4">
                The page you're looking for seems to have been delivered to the wrong address.
                Don't worry, our management system is still cooking up something great!
            </p>
            <p class="text-gray-400 text-sm">
                Error Code: <span class="font-mono bg-gray-800 px-2 py-1 rounded">PAGE_NOT_FOUND</span>
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ url('/dashboard') }}"
               class="w-full sm:w-auto bg-laravel-dark-red hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg text-center">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Back to Dashboard
            </a>

            <button onclick="window.history.back()"
                    class="w-full sm:w-auto bg-laravel-dark-purple hover:bg-purple-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Go Back
            </button>
        </div>

        <!-- Help Links -->
        <div class="mt-8 pt-6 border-t border-gray-600">
            <p class="text-center text-gray-400 text-sm mb-4">
                Need help? Try these links:
            </p>
            <div class="flex flex-wrap justify-center gap-4 text-sm">
                <a href="{{ url('/orders') }}" class="text-laravel-red hover:text-red-400 transition-colors">
                    Orders
                </a>
                <a href="{{ url('/menu') }}" class="text-laravel-red hover:text-red-400 transition-colors">
                    Menu Management
                </a>
                <a href="{{ url('/customers') }}" class="text-laravel-red hover:text-red-400 transition-colors">
                    Customers
                </a>
                <a href="{{ url('/reports') }}" class="text-laravel-red hover:text-red-400 transition-colors">
                    Reports
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center">
            <p class="text-gray-500 text-xs">
                © {{ date('Y') }} Pizza Shop Management System
            </p>
        </div>
    </div>
</div>

<script>
    // Add some interactive elements
    document.addEventListener('DOMContentLoaded', function() {
        // Add click effect to pizza slice
        const pizzaSlice = document.querySelector('.pizza-slice');
        pizzaSlice.addEventListener('click', function() {
            this.style.transform = 'rotate(360deg) scale(1.1)';
            this.style.transition = 'transform 0.8s ease';
            setTimeout(() => {
                this.style.transform = '';
                this.style.transition = '';
            }, 800);
        });

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                window.history.back();
            }
            if (e.key === 'Enter' || e.key === ' ') {
                window.location.href = '{{ url('/') }}';
            }
        });
    });
</script>
</body>
</html>
