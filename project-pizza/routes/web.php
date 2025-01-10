<?php

use App\Http\Controllers\PizzaController;

Route::get('/', [PizzaController::class, 'index'])->name('home');
Route::get('/cart', [PizzaController::class, 'cart'])->name('cart');
Route::post('/cart/add', [PizzaController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/increase', [PizzaController::class, 'increaseQuantity'])->name('cart.increase');
Route::post('/cart/decrease', [PizzaController::class, 'decreaseQuantity'])->name('cart.decrease');
Route::post('/cart/remove', [PizzaController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/checkout', [PizzaController::class, 'checkout'])->name('checkout');


