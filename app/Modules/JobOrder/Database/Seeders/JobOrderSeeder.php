<?php

namespace App\Modules\JobOrder\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\JobOrder\Models\JobOrder;

class JobOrderSeeder extends Seeder
{
    public function run(): void
    {
        JobOrder::create(['name' => 'Sample JobOrder']);

        // Uncomment to use factory if available
        // JobOrder::factory()->count(10)->create();
    }
}
