<?php

namespace App\Modules\Distributor\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Distributor\Models\Distributor;

class DistributorSeeder extends Seeder
{
    public function run(): void
    {
        Distributor::create(['name' => 'Sample Distributor']);

        // Uncomment to use factory if available
        // Distributor::factory()->count(10)->create();
    }
}
