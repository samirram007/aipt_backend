<?php

namespace App\Modules\UniqueQuantityCode\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\UniqueQuantityCode\Contracts\UniqueQuantityCodeServiceInterface;
use App\Modules\UniqueQuantityCode\Services\UniqueQuantityCodeService;

class UniqueQuantityCodeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UniqueQuantityCodeServiceInterface::class, UniqueQuantityCodeService::class);
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
