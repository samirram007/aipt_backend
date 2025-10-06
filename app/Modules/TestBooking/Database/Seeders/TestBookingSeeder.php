<?php

namespace App\Modules\TestBooking\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\TestBooking\Models\TestBooking;

class TestBookingSeeder extends Seeder
{
    public function run(): void
    {
        TestBooking::create(['name' => 'Sample TestBooking']);

        // Uncomment to use factory if available
        // TestBooking::factory()->count(10)->create();
    }
}
