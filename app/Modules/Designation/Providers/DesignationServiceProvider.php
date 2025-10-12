<?php

namespace App\Modules\Designation\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Designation\Contracts\DesignationServiceInterface;
use App\Modules\Designation\Services\DesignationService;

class DesignationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DesignationServiceInterface::class, DesignationService::class);
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
