<?php

namespace App\Modules\RoleFeaturePermission\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\RoleFeaturePermission\Contracts\RoleFeaturePermissionServiceInterface;
use App\Modules\RoleFeaturePermission\Services\RoleFeaturePermissionService;

class RoleFeaturePermissionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RoleFeaturePermissionServiceInterface::class, RoleFeaturePermissionService::class);
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
