<?php

namespace App\Modules\StorageUnit\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\StorageUnit\Contracts\StorageUnitServiceInterface;
use App\Modules\StorageUnit\Services\StorageUnitService;

class StorageUnitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(StorageUnitServiceInterface::class, StorageUnitService::class);
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
