<?php

namespace App\Modules\StockGroup\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockGroup\Contracts\StockGroupServiceInterface;
use App\Modules\StockGroup\Services\StockGroupService;

class StockGroupServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockGroupServiceInterface::class, StockGroupService::class);
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
