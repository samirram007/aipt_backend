<?php

namespace App\Modules\AccountingPeriod\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\AccountingPeriod\Contracts\AccountingPeriodServiceInterface;
use App\Modules\AccountingPeriod\Services\AccountingPeriodService;

class AccountingPeriodServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AccountingPeriodServiceInterface::class, AccountingPeriodService::class);
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
