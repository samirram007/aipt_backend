<?php

namespace App\Modules\StockItemBrand\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockItemBrand\Contracts\StockItemBrandServiceInterface;
use App\Modules\StockItemBrand\Services\StockItemBrandService;

class StockItemBrandServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockItemBrandServiceInterface::class, StockItemBrandService::class);
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
