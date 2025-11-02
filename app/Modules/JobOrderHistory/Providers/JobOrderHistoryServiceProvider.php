<?php

namespace App\Modules\JobOrderHistory\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\JobOrderHistory\Contracts\JobOrderHistoryServiceInterface;
use App\Modules\JobOrderHistory\Services\JobOrderHistoryService;

class JobOrderHistoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(JobOrderHistoryServiceInterface::class, JobOrderHistoryService::class);
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
