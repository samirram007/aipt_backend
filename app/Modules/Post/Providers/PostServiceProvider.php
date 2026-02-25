<?php

namespace App\Modules\Post\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\Post\Contracts\PostServiceInterface;
use App\Modules\Post\Services\PostService;

class PostServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PostServiceInterface::class, PostService::class);
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
