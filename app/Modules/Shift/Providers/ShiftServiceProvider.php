<?php

namespace App\Modules\Shift\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Shift\Contracts\ShiftServiceInterface;
use App\Modules\Shift\Services\ShiftService;

class ShiftServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ShiftServiceInterface::class, ShiftService::class);
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
