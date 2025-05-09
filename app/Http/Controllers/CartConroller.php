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
            $product = Product::where('id',$id)->first();
            if(!empty($product)){
                $cart = session()->get('cart', []);
    
                $cart[$product->id] = [
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => 1,
                    "image" => $product->image
                ];
                session()->put('cart', $cart);
                $cart = session()->get('cart', []);
                return response()->json([
                    'cart_html' => view('partials.view-cart',compact('cart'))->render()
                ]);
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
            // $cartHtml = view('partials.view-cart')->render();
            // return response()->json(['cart_html' => $cartHtml]);

            return response()->json([
                // 'status' =>true,
                // 'current_page' => $data['current_page'],
                // 'has_more'=>$data['has_more'],
                'cart_html' => view('partials.view-cart',compact('cart'))->render()
            ]);
        }

        return response()->json(['message' => 'Product not found in cart.']);
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()]);
    }
}


}
