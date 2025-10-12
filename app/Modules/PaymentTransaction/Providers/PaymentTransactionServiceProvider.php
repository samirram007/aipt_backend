<?php

namespace App\Modules\PaymentTransaction\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\PaymentTransaction\Contracts\PaymentTransactionServiceInterface;
use App\Modules\PaymentTransaction\Services\PaymentTransactionService;

class PaymentTransactionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PaymentTransactionServiceInterface::class, PaymentTransactionService::class);
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
