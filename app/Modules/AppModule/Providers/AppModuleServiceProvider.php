<?php

namespace App\Modules\AppModule\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\AppModule\Contracts\AppModuleServiceInterface;
use App\Modules\AppModule\Services\AppModuleService;

class AppModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AppModuleServiceInterface::class, AppModuleService::class);
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
