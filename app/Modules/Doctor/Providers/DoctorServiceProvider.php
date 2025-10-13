<?php

namespace App\Modules\Doctor\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Doctor\Contracts\DoctorServiceInterface;
use App\Modules\Doctor\Services\DoctorService;

class DoctorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DoctorServiceInterface::class, DoctorService::class);
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
