<?php

namespace App\Modules\StockJournalBatchEntry\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalBatchEntry\Contracts\StockJournalBatchEntryServiceInterface;
use App\Modules\StockJournalBatchEntry\Services\StockJournalBatchEntryService;

class StockJournalBatchEntryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockJournalBatchEntryServiceInterface::class, StockJournalBatchEntryService::class);
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
