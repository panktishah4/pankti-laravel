<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartConroller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);

Route::post('cart/add',[CartConroller::class,'add'])->name('cart.add');
Route::post('/cart/remove', [CartConroller::class, 'remove'])->name('cart.remove');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.submit');
Route::get('/orders', [OrderController::class, 'index'])->name('orders'); 


Route::get('/', function () {
    return view('welcome');
});
