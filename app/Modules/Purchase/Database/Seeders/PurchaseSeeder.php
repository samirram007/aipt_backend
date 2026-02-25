<?php

namespace App\Modules\Purchase\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Purchase\Models\Purchase;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        Purchase::create(['name' => 'Sample Purchase']);

        // Uncomment to use factory if available
        // Purchase::factory()->count(10)->create();
    }
}
