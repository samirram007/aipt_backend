<?php

namespace App\Modules\DeliveryPlace\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\DeliveryPlace\Contracts\DeliveryPlaceServiceInterface;
use App\Modules\DeliveryPlace\Services\DeliveryPlaceService;

class DeliveryPlaceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DeliveryPlaceServiceInterface::class, DeliveryPlaceService::class);
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
