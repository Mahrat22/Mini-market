<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Default route -> Products page
Route::get('/', fn() => redirect()->route('products.index'));

// Product routes (CRUD)
Route::resource('products', ProductController::class);

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
