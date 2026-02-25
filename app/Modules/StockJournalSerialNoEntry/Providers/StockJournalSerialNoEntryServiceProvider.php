<?php

namespace App\Modules\StockJournalSerialNoEntry\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StockJournalSerialNoEntry\Contracts\StockJournalSerialNoEntryServiceInterface;
use App\Modules\StockJournalSerialNoEntry\Services\StockJournalSerialNoEntryService;

class StockJournalSerialNoEntryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StockJournalSerialNoEntryServiceInterface::class, StockJournalSerialNoEntryService::class);
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
