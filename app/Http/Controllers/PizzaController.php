<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PizzaController extends Controller
{
    public function index() {
        $pizzas = Pizza::all();
        return view('pizzas.index', compact('pizzas'));
    }

    public function buy($pizzaId)
    {
        $user = Auth::user();

        // Create new order for this user
        $order = Order::create([
            'user_id' => $user->id
        ]);

        // Create order item (1 qty of the selected pizza)
        OrderItem::create([
            'order_id' => $order->id,
            'pizza_id' => $pizzaId,
            'quantity' => 1
        ]);

        return redirect()->route('orders.history')->with('success', 'Pizza ordered!');
    }
}
