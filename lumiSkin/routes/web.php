<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\ChatGPTService;

Route::controller(App\Http\Controllers\HomeController::class)->group(function (): void {
    Route::get('/', 'index')->name('home.index');
});

Route::controller(App\Http\Controllers\ProductController::class)->group(function (): void {
    Route::get('/products', 'index')->name('product.index');
    Route::get('/products/newest', 'newest')->name('product.newest');
    Route::get('/products/searchByCategory', 'searchByCategory')->name('product.searchByCategory');
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

Route::controller(App\Http\Controllers\OrderController::class)->group(function (): void {
    Route::post('/orders', 'store')->name('orders.store');
    Route::get('/orders/{id}', 'index')->name('orders.index');
});

Route::middleware('admin')->group(function (): void {
    Route::controller(App\Http\Controllers\Admin\AdminHomeController::class)->group(function (): void {
        Route::get('/admin', 'index')->name('admin.home.index');
    });

    Route::controller(App\Http\Controllers\Admin\AdminProductController::class)->group(function (): void {
        Route::get('/admin/products', 'index')->name('admin.product.index');
        Route::post('/admin/products/store', 'store')->name('admin.product.store');
        Route::delete('/admin/products/{id}/delete', 'delete')->name('admin.product.delete');
        Route::get('/admin/products/{id}/edit', 'edit')->name('admin.product.edit');
        Route::put('/admin/products/{id}/update', 'update')->name('admin.product.update');
    });
});

Route::controller(App\Http\Controllers\SkincareTestController::class)->group(function (): void {
    Route::get('/skincare-test', 'index')->name('skincare_test.index');
    Route::post('/skincare-test', 'getRecommendation')->name('skincare_test.recommendation');    
});

Auth::routes();
