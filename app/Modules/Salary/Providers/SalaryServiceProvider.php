<?php

namespace App\Modules\Salary\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Salary\Contracts\SalaryServiceInterface;
use App\Modules\Salary\Services\SalaryService;

class SalaryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SalaryServiceInterface::class, SalaryService::class);
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
