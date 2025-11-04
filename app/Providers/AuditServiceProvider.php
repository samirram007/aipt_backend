<?php
namespace App\Providers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
class AuditServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     */
    public function register(): void
    {

    }
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Register custom blueprint macro
        Blueprint::macro('blamable', function () {
            /** @var \Illuminate\Database\Schema\Blueprint $this */
            $this->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $this->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
        });
    }

}
