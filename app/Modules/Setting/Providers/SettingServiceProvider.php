<?php

namespace App\Modules\Setting\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Setting\Contracts\SettingServiceInterface;
use App\Modules\Setting\Services\SettingService;

class SettingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SettingServiceInterface::class, SettingService::class);
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
