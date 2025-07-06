<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'pizza_id',
        'quantity'
    ];
    public function pizza() {
        return $this->belongsTo(Pizza::class);
    }
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
