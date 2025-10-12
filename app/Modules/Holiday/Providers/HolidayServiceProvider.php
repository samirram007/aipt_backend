<?php

namespace App\Modules\Holiday\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Holiday\Contracts\HolidayServiceInterface;
use App\Modules\Holiday\Services\HolidayService;

class HolidayServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(HolidayServiceInterface::class, HolidayService::class);
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
