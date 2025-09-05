<?php

namespace App\Modules\Unit\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Unit\Contracts\UnitServiceInterface;
use App\Modules\Unit\Services\UnitService;

class UnitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UnitServiceInterface::class, UnitService::class);
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
