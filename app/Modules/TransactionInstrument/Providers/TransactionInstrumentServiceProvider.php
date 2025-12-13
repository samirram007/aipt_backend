<?php

namespace App\Modules\TransactionInstrument\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\TransactionInstrument\Contracts\TransactionInstrumentServiceInterface;
use App\Modules\TransactionInstrument\Services\TransactionInstrumentService;

class TransactionInstrumentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TransactionInstrumentServiceInterface::class, TransactionInstrumentService::class);
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
