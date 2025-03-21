<?php

use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\HomeController::class)->group(function (): void {
    Route::get('/', 'index')->name('home.index');
});

Route::controller(App\Http\Controllers\ProductController::class)->group(function (): void {
    Route::get('/products', 'index')->name('product.index');
});

Route::controller(App\Http\Controllers\CartController::class)->group(function (): void {
    Route::post('/cart/add', 'addToCart')->name('cart.add');
    Route::post('/cart/update/{id}', 'updateCart')->name('cart.update');
    Route::post('/cart/remove/{id}', 'removeFromCart')->name('cart.remove');
    Route::post('/cart/clear', 'clearCart')->name('cart.clear');
});

Route::controller(App\Http\Controllers\CategoryController::class)->group(function (): void {
    Route::get('/categories', 'index')->name('category.index');
    Route::get('/categories/create', 'create')->name('category.create');
    Route::get('/categories/{id}', 'show')->name('category.show');
    Route::post('/categories/store', 'store')->name('category.store');
    Route::delete('/categories/{id}/delete', 'delete')->name('category.delete');
});
