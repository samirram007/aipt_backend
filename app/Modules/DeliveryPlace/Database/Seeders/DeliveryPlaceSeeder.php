<?php

namespace App\Modules\DeliveryPlace\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\DeliveryPlace\Models\DeliveryPlace;

class DeliveryPlaceSeeder extends Seeder
{
    public function run(): void
    {
        DeliveryPlace::create(['name' => 'Sample DeliveryPlace']);

        // Uncomment to use factory if available
        // DeliveryPlace::factory()->count(10)->create();
    }
}
