<?php

namespace App\Modules\AppModuleFeature\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\AppModuleFeature\Contracts\AppModuleFeatureServiceInterface;
use App\Modules\AppModuleFeature\Services\AppModuleFeatureService;

class AppModuleFeatureServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AppModuleFeatureServiceInterface::class, AppModuleFeatureService::class);
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
