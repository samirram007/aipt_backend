<?php

namespace App\Modules\StockSummary\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockSummary\Contracts\StockSummaryServiceInterface;
use App\Modules\StockSummary\Services\StockSummaryService;

class StockSummaryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockSummaryServiceInterface::class, StockSummaryService::class);
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
