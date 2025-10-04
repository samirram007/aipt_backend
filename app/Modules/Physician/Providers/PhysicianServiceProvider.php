<?php

namespace App\Modules\Physician\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Physician\Contracts\PhysicianServiceInterface;
use App\Modules\Physician\Services\PhysicianService;

class PhysicianServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PhysicianServiceInterface::class, PhysicianService::class);
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
