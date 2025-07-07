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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'required|boolean'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pizzas', 'public');
        }

        Pizza::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_available' => $request->has('is_available'),
            'image' => $imagePath,
        ]);

        return redirect()->route('pizzas.index')->with('success', 'Pizza added successfully!');
    }
}
