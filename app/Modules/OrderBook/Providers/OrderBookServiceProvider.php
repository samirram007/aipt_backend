<?php

namespace App\Modules\OrderBook\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\OrderBook\Contracts\OrderBookServiceInterface;
use App\Modules\OrderBook\Services\OrderBookService;

class OrderBookServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OrderBookServiceInterface::class, OrderBookService::class);
    }

    public function boot(): void
    {
        $this->loadRoutes();
        $this->loadMigrations();
    }

    private function loadRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../Routes/api.php');
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
