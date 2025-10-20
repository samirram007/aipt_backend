<?php

namespace App\Modules\DayBook\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\DayBook\Contracts\DayBookServiceInterface;
use App\Modules\DayBook\Services\DayBookService;

class DayBookServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DayBookServiceInterface::class, DayBookService::class);
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
