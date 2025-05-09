<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'image',
        'short_description',
        'price',
        'sku',
    ];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
