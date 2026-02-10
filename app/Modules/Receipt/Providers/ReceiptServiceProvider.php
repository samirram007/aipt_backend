<?php

namespace App\Modules\Receipt\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Receipt\Contracts\ReceiptServiceInterface;
use App\Modules\Receipt\Services\ReceiptService;

class ReceiptServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ReceiptServiceInterface::class, ReceiptService::class);
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
