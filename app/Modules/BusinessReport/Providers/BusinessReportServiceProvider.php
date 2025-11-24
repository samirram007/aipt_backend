<?php

namespace App\Modules\BusinessReport\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\BusinessReport\Contracts\BusinessReportServiceInterface;
use App\Modules\BusinessReport\Services\BusinessReportService;

class BusinessReportServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BusinessReportServiceInterface::class, BusinessReportService::class);
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
