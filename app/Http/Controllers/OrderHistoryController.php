<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.pizza')
            ->where('user_id', Auth::id())
            ->get();

        return view('orders.history', compact('orders'));
    }
}
