<?php

namespace App\Modules\VoucherClassification\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\VoucherClassification\Contracts\VoucherClassificationServiceInterface;
use App\Modules\VoucherClassification\Services\VoucherClassificationService;

class VoucherClassificationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(VoucherClassificationServiceInterface::class, VoucherClassificationService::class);
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
