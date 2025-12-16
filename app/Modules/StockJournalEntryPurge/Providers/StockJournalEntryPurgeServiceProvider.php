<?php

namespace App\Modules\StockJournalEntryPurge\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalEntryPurge\Contracts\StockJournalEntryPurgeServiceInterface;
use App\Modules\StockJournalEntryPurge\Services\StockJournalEntryPurgeService;

class StockJournalEntryPurgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockJournalEntryPurgeServiceInterface::class, StockJournalEntryPurgeService::class);
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
