<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartConroller extends Controller
{
    public function add(Request $request){
        try {
            $id = $request->product_id;
            $product = Product::findOrFail($id);
            if(!empty($product)){
                $cart = session()->get('cart', []);
        
                /* For multiple products add in cart with quantity 1 */
                $cart[$product->id] = [
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => 1,
                    "image" => $product->image
                ];
               
                session()->put('cart', $cart);
                return response()->json(['message' => 'Product added to cart.']);
            }else{
                return response()->json(['message' => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function remove(Request $request){
    try {
        $productId = $request->product_id;
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]); 
            session()->put('cart', $cart); 

            return response()->json(['message' => 'Product removed from cart.']);
        }

        return response()->json(['message' => 'Product not found in cart.']);
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()]);
    }
}


}
