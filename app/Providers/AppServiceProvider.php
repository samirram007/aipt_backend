<?php

namespace App\Providers;

use App\Modules\Agent\Models\Agent;
use App\Modules\Customer\Models\Customer;
use App\Modules\Distributor\Models\Distributor;
use App\Modules\Employee\Models\Employee;
<<<<<<< HEAD
use App\Modules\Patient\Models\Patient;
=======
use App\Modules\Supplier\Models\Supplier;
use App\Modules\Transporter\Models\Transporter;
>>>>>>> d45c33df38caf7eec8f2977201c0d60d55c888b7
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
        ]);
    }
}
