<?php

namespace App\Modules\StockJournalGodownEntry\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalGodownEntry\Contracts\StockJournalGodownEntryServiceInterface;
use App\Modules\StockJournalGodownEntry\Services\StockJournalGodownEntryService;

class StockJournalGodownEntryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockJournalGodownEntryServiceInterface::class, StockJournalGodownEntryService::class);
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
