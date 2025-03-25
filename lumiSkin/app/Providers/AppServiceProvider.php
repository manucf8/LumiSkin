<?php

namespace App\Providers;

use App\Contracts\RecommendationServiceInterface;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Services\ChatGPTService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            RecommendationServiceInterface::class,
            ChatGPTService::class);
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
    }
}
