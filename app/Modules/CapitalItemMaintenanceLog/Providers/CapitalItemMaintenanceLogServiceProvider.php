<?php

namespace App\Modules\CapitalItemMaintenanceLog\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\CapitalItemMaintenanceLog\Contracts\CapitalItemMaintenanceLogServiceInterface;
use App\Modules\CapitalItemMaintenanceLog\Services\CapitalItemMaintenanceLogService;

class CapitalItemMaintenanceLogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CapitalItemMaintenanceLogServiceInterface::class, CapitalItemMaintenanceLogService::class);
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
