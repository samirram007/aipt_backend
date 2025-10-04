<?php

namespace App\Modules\Transporter\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Transporter\Contracts\TransporterServiceInterface;
use App\Modules\Transporter\Services\TransporterService;

class TransporterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TransporterServiceInterface::class, TransporterService::class);
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
