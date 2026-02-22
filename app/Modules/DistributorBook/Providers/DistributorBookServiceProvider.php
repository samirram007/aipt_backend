<?php

namespace App\Modules\DistributorBook\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\DistributorBook\Contracts\DistributorBookServiceInterface;
use App\Modules\DistributorBook\Services\DistributorBookService;

class DistributorBookServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DistributorBookServiceInterface::class, DistributorBookService::class);
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
