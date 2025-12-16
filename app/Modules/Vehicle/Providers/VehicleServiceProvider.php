<?php

namespace App\Modules\Vehicle\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Vehicle\Contracts\VehicleServiceInterface;
use App\Modules\Vehicle\Services\VehicleService;

class VehicleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(VehicleServiceInterface::class, VehicleService::class);
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
