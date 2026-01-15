<?php

namespace App\Modules\FacilityCapitalItem\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\FacilityCapitalItem\Contracts\FacilityCapitalItemServiceInterface;
use App\Modules\FacilityCapitalItem\Services\FacilityCapitalItemService;

class FacilityCapitalItemServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FacilityCapitalItemServiceInterface::class, FacilityCapitalItemService::class);
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
