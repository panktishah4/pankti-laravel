<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product; 
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function store(Request $request){
       
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'city'  => 'required|string|max:100',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $order = Order::create([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city'  => $request->city,
        ]);

       
        foreach ($cart as $key => $item) {
            
            $product = Product::find($key);
           
            if ($product) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $product->id,
                    'quantity'     => $item['quantity'] ?? 1, 
                    'price'        => $product->price,      
                ]);
            }
        }
        Session::forget('cart');
        return redirect()->back()->with('success', 'Order placed successfully!');
    }

    public function index(){
        $orders = Order::with('items')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }
}
