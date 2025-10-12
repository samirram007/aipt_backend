<?php

namespace App\Modules\Grade\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Grade\Contracts\GradeServiceInterface;
use App\Modules\Grade\Services\GradeService;

class GradeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(GradeServiceInterface::class, GradeService::class);
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
