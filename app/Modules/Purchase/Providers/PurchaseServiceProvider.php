<?php

namespace App\Modules\Purchase\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Purchase\Contracts\PurchaseServiceInterface;
use App\Modules\Purchase\Services\PurchaseService;

class PurchaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PurchaseServiceInterface::class, PurchaseService::class);
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
