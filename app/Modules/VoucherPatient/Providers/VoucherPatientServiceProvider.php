<?php

namespace App\Modules\VoucherPatient\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\VoucherPatient\Contracts\VoucherPatientServiceInterface;
use App\Modules\VoucherPatient\Services\VoucherPatientService;

class VoucherPatientServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(VoucherPatientServiceInterface::class, VoucherPatientService::class);
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
