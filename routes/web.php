<?php

use App\Http\Controllers\CartConroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);

Route::post('cart/add',[CartConroller::class,'add'])->name('cart.add');
Route::post('/cart/remove', [CartConroller::class, 'remove'])->name('cart.remove');



Route::get('/', function () {
    return view('welcome');
});
