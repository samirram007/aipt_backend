<?php

namespace App\Modules\Supplier\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Supplier\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create(['name' => 'Sample Supplier']);

        // Uncomment to use factory if available
        // Supplier::factory()->count(10)->create();
    }
}
