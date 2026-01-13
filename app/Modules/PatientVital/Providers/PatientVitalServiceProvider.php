<?php

namespace App\Modules\PatientVital\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\PatientVital\Contracts\PatientVitalServiceInterface;
use App\Modules\PatientVital\Services\PatientVitalService;

class PatientVitalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PatientVitalServiceInterface::class, PatientVitalService::class);
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
