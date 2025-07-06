<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pizza;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizzaShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Pizza::create([
//            'name' => 'Pepperoni',
//            'description' => 'Spicy beef',
//            'price' => 22.90,
//            'is_available' => true
//        ]);
//
//        Order::create([
//            'customer_name' => 'Ali Bin Abu'
//        ]);
//
//        OrderItem::create(['order_id' => 1, 'pizza_id' => 1, 'quantity' => 2]);
        // Seed more pizzas
        Pizza::create([
            'name' => 'Margherita',
            'description' => 'Classic cheese and tomato',
            'price' => 18.50,
            'is_available' => true
        ]);

        Pizza::create([
            'name' => 'Hawaiian',
            'description' => 'Pineapple and chicken',
            'price' => 20.00,
            'is_available' => true
        ]);

        Pizza::create([
            'name' => 'Meat Lovers',
            'description' => 'Sausage, pepperoni, beef, ham',
            'price' => 25.90,
            'is_available' => false
        ]);

// Seed more orders
        Order::create([
            'customer_name' => 'Siti Nurhaliza'
        ]);

        Order::create([
            'customer_name' => 'John Tan'
        ]);

// Seed more order items
        OrderItem::create(['order_id' => 2, 'pizza_id' => 2, 'quantity' => 1]); // Siti orders 1 Margherita
        OrderItem::create(['order_id' => 2, 'pizza_id' => 3, 'quantity' => 1]); // Siti orders 1 Hawaiian
        OrderItem::create(['order_id' => 3, 'pizza_id' => 1, 'quantity' => 3]); // John orders 3 Pepperoni

    }
}
