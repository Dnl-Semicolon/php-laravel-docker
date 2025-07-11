<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'is_available',
        'image',
    ];

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
}
