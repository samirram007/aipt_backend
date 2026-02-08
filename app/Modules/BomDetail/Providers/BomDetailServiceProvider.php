<?php

namespace App\Modules\BomDetail\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\BomDetail\Contracts\BomDetailServiceInterface;
use App\Modules\BomDetail\Services\BomDetailService;

class BomDetailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BomDetailServiceInterface::class, BomDetailService::class);
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
