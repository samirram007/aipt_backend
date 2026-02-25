<?php

namespace App\Modules\Uqc\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Uqc\Contracts\UqcServiceInterface;
use App\Modules\Uqc\Services\UqcService;

class UqcServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UqcServiceInterface::class, UqcService::class);
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
