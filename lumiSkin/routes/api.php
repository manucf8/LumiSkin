<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::get('/products', [\App\Http\Controllers\Api\ProductApiController::class, 'index']);
    Route::get('/products/{id}', [\App\Http\Controllers\Api\ProductApiController::class, 'show']);
});