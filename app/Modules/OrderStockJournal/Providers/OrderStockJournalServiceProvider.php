<?php

namespace App\Modules\OrderStockJournal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\OrderStockJournal\Contracts\OrderStockJournalServiceInterface;
use App\Modules\OrderStockJournal\Services\OrderStockJournalService;

class OrderStockJournalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OrderStockJournalServiceInterface::class, OrderStockJournalService::class);
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
