<?php

namespace App\Providers;

use App\Modules\Agent\Models\Agent;
use App\Modules\Customer\Models\Customer;
use App\Modules\DeliveryPlace\Models\DeliveryPlace;
use App\Modules\Distributor\Models\Distributor;
use App\Modules\Employee\Models\Employee;
use App\Modules\Godown\Models\Godown;
use App\Modules\Supplier\Models\Supplier;
use App\Modules\Transporter\Models\Transporter;
use App\Modules\Vendor\Models\Vendor;

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
            'agent' => Agent::class,
            'customer' => Customer::class,
            'distributor' => Distributor::class,
            'employee' => Employee::class,
            'godown' => Godown::class,
            'supplier' => Supplier::class,
            'transporter' => Transporter::class,
            'vendor' => Vendor::class,
            'delivery_place' => DeliveryPlace::class,
        ]);
    }
}
