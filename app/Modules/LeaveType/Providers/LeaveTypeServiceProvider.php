<?php

namespace App\Modules\LeaveType\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\LeaveType\Contracts\LeaveTypeServiceInterface;
use App\Modules\LeaveType\Services\LeaveTypeService;

class LeaveTypeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LeaveTypeServiceInterface::class, LeaveTypeService::class);
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
