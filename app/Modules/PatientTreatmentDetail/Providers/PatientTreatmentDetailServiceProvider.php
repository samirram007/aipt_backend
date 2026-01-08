<?php

namespace App\Modules\PatientTreatmentDetail\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\PatientTreatmentDetail\Contracts\PatientTreatmentDetailServiceInterface;
use App\Modules\PatientTreatmentDetail\Services\PatientTreatmentDetailService;

class PatientTreatmentDetailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PatientTreatmentDetailServiceInterface::class, PatientTreatmentDetailService::class);
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
