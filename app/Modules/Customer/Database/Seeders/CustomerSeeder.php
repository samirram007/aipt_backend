<?php

namespace App\Modules\Customer\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Customer\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::create(['name' => 'Sample Customer']);

        // Uncomment to use factory if available
        // Customer::factory()->count(10)->create();
    }
}
