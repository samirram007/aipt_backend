<?php

namespace App\Providers;

use App\Modules\Agent\Models\Agent;
<<<<<<< HEAD
use App\Modules\Bed\Models\Bed;
use App\Modules\Building\Models\Building;
=======
use App\Modules\Company\Models\Company;
>>>>>>> 834255e73cd7172752846e6d810856f53c86f4c7
use App\Modules\Customer\Models\Customer;
use App\Modules\DeliveryPlace\Models\DeliveryPlace;
use App\Modules\Distributor\Models\Distributor;
use App\Modules\Employee\Models\Employee;
use App\Modules\Floor\Models\Floor;
use App\Modules\Godown\Models\Godown;
<<<<<<< HEAD
use App\Modules\Room\Models\Room;
=======
use App\Modules\StorageUnit\Models\StorageUnit;
>>>>>>> 834255e73cd7172752846e6d810856f53c86f4c7
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
    public function register(): void {}

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
<<<<<<< HEAD
            'room' => Room::class,
            'bed' => Bed::class,
            'floor' => Floor::class,
            'building' => Building::class
=======
            'company' => Company::class,
            'storage_unit' => StorageUnit::class,
>>>>>>> 834255e73cd7172752846e6d810856f53c86f4c7
        ]);
    }
}
