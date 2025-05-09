<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable = [
        'name', 'email', 'phone', 'city'
    ];
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    
}
