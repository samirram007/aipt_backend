<?php

namespace App\Modules\FacilityAmenity\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\FacilityAmenity\Contracts\FacilityAmenityServiceInterface;
use App\Modules\FacilityAmenity\Services\FacilityAmenityService;

class FacilityAmenityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FacilityAmenityServiceInterface::class, FacilityAmenityService::class);
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
