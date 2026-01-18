<?php

namespace App\Modules\StorageUnit\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StorageUnit\Models\StorageUnit;

class StorageUnitSeeder extends Seeder
{
    // php artisan db:seed --class="App\Modules\StorageUnit\Database\Seeders\StorageUnitSeeder"

    public function run(): void
    {
        StorageUnit::create([
            'name' => 'Main Storage Unit',
            'code' => 'SU-1',
            'description' => 'Main Storage Unit Description',
            'status' => 'active',
            'icon' => 'fas fa-box',
            'storage_unit_type' => 'FACILITY',
            'storage_unit_category' => 'PHYSICAL',
            'parent_id' => null,
            'is_virtual' => false,
            'is_mobile' => false,
            'capacity_value' => null,
            'capacity_unit_id' => null,
            'temperature_min' => null,
            'temperature_max' => null,
            'our_stock_with_third_party' => false,
            'third_party_stock_with_us' => false,
        ]);
    }
}
