<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\StripeClient;

class CartController extends Controller
{
    public function addToCart($pizzaId)
    {
        $pizza = Pizza::findOrFail($pizzaId);
        $cart = session()->get('cart', []);

        if (isset($cart[$pizzaId])) {
            $cart[$pizzaId]['quantity']++;
        } else {
            $cart[$pizzaId] = [
                'name' => $pizza->name,
                'price' => $pizza->price,
                'quantity' => 1
            ];
        }

        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Pizza added to cart!');
    }

    public function show()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function updateQuantity(Request $request, $pizzaId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$pizzaId])) {
            $cart[$pizzaId]['quantity'] = (int) $request->quantity;
            if ($cart[$pizzaId]['quantity'] <= 0) {
                unset($cart[$pizzaId]);
            }
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.show');
    }

    public function removeItem($pizzaId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$pizzaId])) {
            unset($cart[$pizzaId]);
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.show');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.show')->with('success', 'Cart has been cleared.');
    }

//    public function checkout(Request $request)
//    {
//        $cart = session('cart', []);
//
//        if (empty($cart)) {
//            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
//        }
//
//        $user = Auth::user();
//        $order = Order::create([
//            'user_id' => $user->id,
//            'status' => 'pending',
//        ]);
//
//        foreach ($cart as $pizzaId => $item) {
//            OrderItem::create([
//                'order_id' => $order->id,
//                'pizza_id' => $pizzaId,
//                'quantity' => $item['quantity'],
//            ]);
//        }
//
//        session()->forget('cart');
//
//        return view('checkout.success');
//    }

    public function addressForm()
    {
        if (empty(session('cart'))) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        $address = session('checkout_address', []);

        return view('checkout.address', compact('address'));
    }

    public function processAddress(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ]);

        session(['checkout_address' => $validated]);

        return redirect()->route('checkout'); // this POSTs to Stripe session as before
        // return view('checkout.confirm');
    }


    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        $address = session('checkout_address');

        if (empty($cart) || empty($address)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($cart as $id => $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100, // in cents
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.address'),
        ]);

        return redirect($session->url);
    }

    public function checkoutSuccess(Request $request)
    {
        $cart = session('cart', []);
        $address = session('checkout_address');

        if (empty($cart) || empty($address)) {
            return redirect()->route('pizzas.index');
        }

        $user = Auth::user();

        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_price' => $grandTotal,
            'full_name' => $address['full_name'],
            'phone' => $address['phone'],
            'address_line1' => $address['address_line1'],
            'address_line2' => $address['address_line2'],
            'city' => $address['city'],
            'state' => $address['state'],
            'postal_code' => $address['postal_code'],
        ]);

        foreach ($cart as $pizzaId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'pizza_id' => $pizzaId,
                'quantity' => $item['quantity'],
            ]);
        }

        session()->forget('cart');
        session()->forget('checkout_address');

        return view('checkout.success'); // make a cute page
    }

}
