<?php

namespace App\Modules\DocumentUser\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\DocumentUser\Contracts\DocumentUserServiceInterface;
use App\Modules\DocumentUser\Services\DocumentUserService;

class DocumentUserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DocumentUserServiceInterface::class, DocumentUserService::class);
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
