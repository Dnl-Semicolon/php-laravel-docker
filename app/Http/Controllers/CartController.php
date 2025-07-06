<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        $user = Auth::user();
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        foreach ($cart as $pizzaId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'pizza_id' => $pizzaId,
                'quantity' => $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return view('checkout.success');
    }
}
