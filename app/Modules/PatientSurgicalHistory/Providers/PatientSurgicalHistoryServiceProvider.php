<?php

namespace App\Modules\PatientSurgicalHistory\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\PatientSurgicalHistory\Contracts\PatientSurgicalHistoryServiceInterface;
use App\Modules\PatientSurgicalHistory\Services\PatientSurgicalHistoryService;

class PatientSurgicalHistoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PatientSurgicalHistoryServiceInterface::class, PatientSurgicalHistoryService::class);
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
