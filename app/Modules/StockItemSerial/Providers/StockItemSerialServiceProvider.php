<?php

namespace App\Modules\StockItemSerial\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockItemSerial\Contracts\StockItemSerialServiceInterface;
use App\Modules\StockItemSerial\Services\StockItemSerialService;

class StockItemSerialServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockItemSerialServiceInterface::class, StockItemSerialService::class);
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
