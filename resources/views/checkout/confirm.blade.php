<x-app-layout title="Confirming...">
    <div class="py-20 text-center">
        <h2 class="text-xl font-semibold mb-4">Redirecting to Stripe...</h2>
        <p class="text-gray-500">Please wait while we prepare your checkout session.</p>

        <form id="checkout-form" action="{{ route('checkout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>

    <script>
        document.getElementById('checkout-form').submit();
    </script>
</x-app-layout>
