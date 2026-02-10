<?php

namespace App\Modules\VoucherPaymentMode\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\VoucherPaymentMode\Contracts\VoucherPaymentModeServiceInterface;
use App\Modules\VoucherPaymentMode\Services\VoucherPaymentModeService;

class VoucherPaymentModeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(VoucherPaymentModeServiceInterface::class, VoucherPaymentModeService::class);
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
