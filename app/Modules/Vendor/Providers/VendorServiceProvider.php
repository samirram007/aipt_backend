<?php

namespace App\Modules\Vendor\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Vendor\Contracts\VendorServiceInterface;
use App\Modules\Vendor\Services\VendorService;

class VendorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(VendorServiceInterface::class, VendorService::class);
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
