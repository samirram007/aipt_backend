<?php

namespace App\Modules\DiscountType\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\DiscountType\Contracts\DiscountTypeServiceInterface;
use App\Modules\DiscountType\Services\DiscountTypeService;

class DiscountTypeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DiscountTypeServiceInterface::class, DiscountTypeService::class);
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
