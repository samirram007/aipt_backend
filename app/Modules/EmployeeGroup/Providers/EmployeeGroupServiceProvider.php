<?php

namespace App\Modules\EmployeeGroup\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\EmployeeGroup\Contracts\EmployeeGroupServiceInterface;
use App\Modules\EmployeeGroup\Services\EmployeeGroupService;

class EmployeeGroupServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EmployeeGroupServiceInterface::class, EmployeeGroupService::class);
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
