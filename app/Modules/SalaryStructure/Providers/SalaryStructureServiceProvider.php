<?php

namespace App\Modules\SalaryStructure\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\SalaryStructure\Contracts\SalaryStructureServiceInterface;
use App\Modules\SalaryStructure\Services\SalaryStructureService;

class SalaryStructureServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SalaryStructureServiceInterface::class, SalaryStructureService::class);
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
