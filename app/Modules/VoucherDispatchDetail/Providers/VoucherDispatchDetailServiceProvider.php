<?php

namespace App\Modules\VoucherDispatchDetail\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\VoucherDispatchDetail\Contracts\VoucherDispatchDetailServiceInterface;
use App\Modules\VoucherDispatchDetail\Services\VoucherDispatchDetailService;

class VoucherDispatchDetailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(VoucherDispatchDetailServiceInterface::class, VoucherDispatchDetailService::class);
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
