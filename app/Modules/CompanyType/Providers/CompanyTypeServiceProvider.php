<?php

namespace App\Modules\CompanyType\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\CompanyType\Contracts\CompanyTypeServiceInterface;
use App\Modules\CompanyType\Services\CompanyTypeService;

class CompanyTypeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CompanyTypeServiceInterface::class, CompanyTypeService::class);
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
