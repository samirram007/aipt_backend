<?php

namespace App\Modules\OrderJournal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\OrderJournal\Contracts\OrderJournalServiceInterface;
use App\Modules\OrderJournal\Services\OrderJournalService;

class OrderJournalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OrderJournalServiceInterface::class, OrderJournalService::class);
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
