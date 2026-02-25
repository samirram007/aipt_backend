<?php

namespace App\Modules\StockItem\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockItem\Contracts\StockItemServiceInterface;
use App\Modules\StockItem\Services\StockItemService;

class StockItemServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockItemServiceInterface::class, StockItemService::class);
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
