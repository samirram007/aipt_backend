<?php

namespace App\Modules\StockUnit\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockUnit\Contracts\StockUnitServiceInterface;
use App\Modules\StockUnit\Services\StockUnitService;

class StockUnitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockUnitServiceInterface::class, StockUnitService::class);
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
