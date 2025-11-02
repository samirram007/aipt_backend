<?php

namespace App\Modules\JobOrderHistory\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\JobOrderHistory\Models\JobOrderHistory;

class JobOrderHistorySeeder extends Seeder
{
    public function run(): void
    {
        JobOrderHistory::create(['name' => 'Sample JobOrderHistory']);

        // Uncomment to use factory if available
        // JobOrderHistory::factory()->count(10)->create();
    }
}
