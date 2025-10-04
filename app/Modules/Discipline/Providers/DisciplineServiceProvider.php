<?php

namespace App\Modules\Discipline\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Discipline\Contracts\DisciplineServiceInterface;
use App\Modules\Discipline\Services\DisciplineService;

class DisciplineServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DisciplineServiceInterface::class, DisciplineService::class);
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
