<?php

namespace App\Modules\StockItemBatch\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockItemBatch\Contracts\StockItemBatchServiceInterface;
use App\Modules\StockItemBatch\Services\StockItemBatchService;

class StockItemBatchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockItemBatchServiceInterface::class, StockItemBatchService::class);
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
