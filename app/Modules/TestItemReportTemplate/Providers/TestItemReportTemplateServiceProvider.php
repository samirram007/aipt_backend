<?php

namespace App\Modules\TestItemReportTemplate\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\TestItemReportTemplate\Contracts\TestItemReportTemplateServiceInterface;
use App\Modules\TestItemReportTemplate\Services\TestItemReportTemplateService;

class TestItemReportTemplateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TestItemReportTemplateServiceInterface::class, TestItemReportTemplateService::class);
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
