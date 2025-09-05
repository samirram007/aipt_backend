<?php

namespace App\Providers;

use App\Services\IAccountGroupService;
use App\Services\IAuthService;
use App\Services\impl\AccountGroupService;
use App\Services\impl\AuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
