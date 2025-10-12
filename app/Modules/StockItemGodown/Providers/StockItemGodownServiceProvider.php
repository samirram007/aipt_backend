<?php

namespace App\Modules\StockItemGodown\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockItemGodown\Contracts\StockItemGodownServiceInterface;
use App\Modules\StockItemGodown\Services\StockItemGodownService;

class StockItemGodownServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockItemGodownServiceInterface::class, StockItemGodownService::class);
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
