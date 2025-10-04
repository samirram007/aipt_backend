<?php

namespace App\Modules\StockJournal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockJournal\Contracts\StockJournalServiceInterface;
use App\Modules\StockJournal\Services\StockJournalService;

class StockJournalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockJournalServiceInterface::class, StockJournalService::class);
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
