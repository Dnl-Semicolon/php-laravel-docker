<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::with('items.pizza')->get();
        return view('orders.index', compact('orders'));
    }
}
