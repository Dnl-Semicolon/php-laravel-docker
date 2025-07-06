<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class AdminPizzaController extends Controller
{
    public function create()
    {
        return view('admin.pizzas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean'
        ]);

        Pizza::create($request->only('name', 'description', 'price', 'is_available'));

        return redirect()->route('pizzas.index')->with('success', 'Pizza added successfully!');
    }
}
