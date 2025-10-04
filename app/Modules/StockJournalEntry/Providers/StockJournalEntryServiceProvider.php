<?php

namespace App\Modules\StockJournalEntry\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalEntry\Contracts\StockJournalEntryServiceInterface;
use App\Modules\StockJournalEntry\Services\StockJournalEntryService;

class StockJournalEntryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockJournalEntryServiceInterface::class, StockJournalEntryService::class);
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
