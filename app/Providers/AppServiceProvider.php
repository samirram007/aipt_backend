<?php

namespace App\Providers;

use App\Modules\Agent\Models\Agent;
use App\Modules\Customer\Models\Customer;
use App\Modules\Distributor\Models\Distributor;
use App\Modules\Employee\Models\Employee;
use App\Modules\Patient\Models\Patient;
use App\Modules\Supplier\Models\Supplier;
use App\Modules\Transporter\Models\Transporter;
use App\Modules\Vendor\Models\Vendor;
use App\Services\IAccountGroupService;
use App\Services\IAuthService;
use App\Services\impl\AccountGroupService;
use App\Services\impl\AuthService;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        Relation::enforceMorphMap([
            'customer' => Customer::class,
            'distributor' => Distributor::class,
            'supplier' => Supplier::class,
            'transporter' => Transporter::class,
            'employee' => Employee::class,
            'vendor' => Vendor::class,
            'agent' => Agent::class,
            'patient' => Patient::class
        ]);
    }
}
