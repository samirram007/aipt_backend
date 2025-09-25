<?php

namespace App\Modules\Vendor\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Vendor\Models\Vendor;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        Vendor::create(['name' => 'Sample Vendor']);

        // Uncomment to use factory if available
        // Vendor::factory()->count(10)->create();
    }
}
