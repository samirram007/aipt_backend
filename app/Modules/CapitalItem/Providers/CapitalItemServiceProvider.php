<?php

namespace App\Modules\CapitalItem\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\CapitalItem\Contracts\CapitalItemServiceInterface;
use App\Modules\CapitalItem\Services\CapitalItemService;

class CapitalItemServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CapitalItemServiceInterface::class, CapitalItemService::class);
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
