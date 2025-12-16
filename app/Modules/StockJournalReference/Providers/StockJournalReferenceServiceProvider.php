<?php

namespace App\Modules\StockJournalReference\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalReference\Contracts\StockJournalReferenceServiceInterface;
use App\Modules\StockJournalReference\Services\StockJournalReferenceService;

class StockJournalReferenceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockJournalReferenceServiceInterface::class, StockJournalReferenceService::class);
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
