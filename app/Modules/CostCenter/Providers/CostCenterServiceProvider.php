<?php

namespace App\Modules\CostCenter\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\CostCenter\Contracts\CostCenterServiceInterface;
use App\Modules\CostCenter\Services\CostCenterService;

class CostCenterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CostCenterServiceInterface::class, CostCenterService::class);
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
