<?php

namespace App\Modules\TestItem\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\TestItem\Contracts\TestItemServiceInterface;
use App\Modules\TestItem\Services\TestItemService;

class TestItemServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TestItemServiceInterface::class, TestItemService::class);
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
