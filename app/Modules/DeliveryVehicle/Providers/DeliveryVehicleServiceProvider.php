<?php

namespace App\Modules\DeliveryVehicle\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\DeliveryVehicle\Contracts\DeliveryVehicleServiceInterface;
use App\Modules\DeliveryVehicle\Services\DeliveryVehicleService;

class DeliveryVehicleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DeliveryVehicleServiceInterface::class, DeliveryVehicleService::class);
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
