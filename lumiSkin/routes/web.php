<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
});

Route::controller(App\Http\Controllers\OrderController::class)->group(function (): void {
    Route::post('/orders', 'store')->name('order.store');
    Route::get('/orders/{id}', 'index')->name('order.index');
    Route::get('/orders/{id}/pdf', 'downloadPdf')->name('order.pdf');
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

    Route::controller(App\Http\Controllers\Admin\AdminCategoryController::class)->group(function (): void {
        Route::get('/admin/categories', 'index')->name('admin.category.index');
        Route::post('/admin/categories/store', 'store')->name('admin.category.store');
        Route::delete('/admin/categories/{id}/delete', 'delete')->name('admin.category.delete');
        Route::get('/admin/categories/{id}/edit', 'edit')->name('admin.category.edit');
        Route::put('/admin/categories/{id}/update', 'update')->name('admin.category.update');
    });
});

Route::middleware(['auth'])->group(function (): void {
    Route::controller(App\Http\Controllers\ProfileController::class)->group(function (): void {
        Route::get('/profile', 'index')->name('profile.index');
        Route::post('/profile/increaseBalance', 'increaseBalance')->name('profile.increaseBalance');
    });
    Route::controller(App\Http\Controllers\SkincareTestController::class)->group(function (): void {
        Route::get('/skincare-test', 'index')->name('skincareTest.index');
        Route::post('/skincare-test', 'store')->name('skincareTest.store');
        Route::get('/skincare-recommendation/{test}', 'getRecommendation')->name('skincareTest.recommendation');
        Route::get('/skincare-test/{test}/routine', 'generateRoutine')->name('skincareTest.routine');
    });
});

Auth::routes();
