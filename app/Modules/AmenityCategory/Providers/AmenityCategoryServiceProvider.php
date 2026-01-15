<?php

namespace App\Modules\AmenityCategory\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\AmenityCategory\Contracts\AmenityCategoryServiceInterface;
use App\Modules\AmenityCategory\Services\AmenityCategoryService;

class AmenityCategoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AmenityCategoryServiceInterface::class, AmenityCategoryService::class);
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
