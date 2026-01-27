<?php

namespace App\Modules\PhysicalStock\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\PhysicalStock\Contracts\PhysicalStockServiceInterface;
use App\Modules\PhysicalStock\Services\PhysicalStockService;

class PhysicalStockServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PhysicalStockServiceInterface::class, PhysicalStockService::class);
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
