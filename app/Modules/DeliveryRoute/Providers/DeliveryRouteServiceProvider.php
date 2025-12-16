<?php

namespace App\Modules\DeliveryRoute\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\DeliveryRoute\Contracts\DeliveryRouteServiceInterface;
use App\Modules\DeliveryRoute\Services\DeliveryRouteService;

class DeliveryRouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DeliveryRouteServiceInterface::class, DeliveryRouteService::class);
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
