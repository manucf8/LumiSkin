<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");

Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name("admin.product.index");

Route::controller(App\Http\Controllers\CategoryController::class)->group(function (): void {
    Route::get('/categories', 'index')->name('category.index');
    Route::get('/categories/create', 'create')->name('category.create');
    Route::get('/categories/{id}', 'show')->name('category.show');
    Route::post('/categories/store', 'store')->name('category.store');
    Route::delete('/categories/{id}/delete', 'delete')->name('category.delete');
});
