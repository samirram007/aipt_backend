<?php

namespace App\Modules\AccountsJournal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\AccountsJournal\Contracts\AccountsJournalServiceInterface;
use App\Modules\AccountsJournal\Services\AccountsJournalService;

class AccountsJournalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AccountsJournalServiceInterface::class, AccountsJournalService::class);
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
