<?php

namespace App\Modules\TestCancellationRequest\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\TestCancellationRequest\Contracts\TestCancellationRequestServiceInterface;
use App\Modules\TestCancellationRequest\Services\TestCancellationRequestService;

class TestCancellationRequestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TestCancellationRequestServiceInterface::class, TestCancellationRequestService::class);
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
