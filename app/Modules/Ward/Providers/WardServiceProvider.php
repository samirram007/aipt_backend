<?php

namespace App\Modules\Ward\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Ward\Contracts\WardServiceInterface;
use App\Modules\Ward\Services\WardService;

class WardServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(WardServiceInterface::class, WardService::class);
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
