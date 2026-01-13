<?php

namespace App\Modules\PatientAllergy\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\PatientAllergy\Contracts\PatientAllergyServiceInterface;
use App\Modules\PatientAllergy\Services\PatientAllergyService;

class PatientAllergyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PatientAllergyServiceInterface::class, PatientAllergyService::class);
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
