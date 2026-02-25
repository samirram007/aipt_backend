<?php

namespace App\Modules\AccountNature\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\AccountNature\Contracts\AccountNatureServiceInterface;
use App\Modules\AccountNature\Services\AccountNatureService;

class AccountNatureServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AccountNatureServiceInterface::class, AccountNatureService::class);
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
