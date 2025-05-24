<?php

/**
 * Authors:
 * - Sara Valentina Cortes Manrique
 * - Manuela Castaño Franco
 */

namespace App\Providers;

use App\Contracts\RecommendationServiceInterface;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Services\ChatGPTService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            RecommendationServiceInterface::class,
            ChatGPTService::class
        );
        $this->app->bind(
            \App\Contracts\FileStorageInterface::class,
            \App\Services\LocalFileStorageService::class
        );
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        Route::aliasMiddleware('admin', AdminAuthMiddleware::class);

        View::composer('*', function ($view) {
            $cart = session('cart', []);
            $cartItems = [];

            foreach ($cart as $id => $quantity) {
                $product = Product::find($id);
                if ($product) {
                    $cartItems[] = [
                        'id' => $id,
                        'name' => $product->getName(),
                        'price' => $product->getPrice(),
                        'quantity' => $quantity,
                    ];
                }
            }

            $view->with('cartItems', $cartItems)
                ->with('cartQuantity', Product::calculateTotalQuantity())
                ->with('cartTotal', Product::calculateTotal());
        });
    }
}
