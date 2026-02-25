<?php

namespace App\Modules\Distributor\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Distributor\Contracts\DistributorServiceInterface;
use App\Modules\Distributor\Services\DistributorService;

class DistributorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DistributorServiceInterface::class, DistributorService::class);
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
