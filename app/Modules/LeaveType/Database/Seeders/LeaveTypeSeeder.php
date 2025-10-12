<?php

namespace App\Modules\LeaveType\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\LeaveType\Models\LeaveType;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        LeaveType::create(['name' => 'Sample LeaveType']);

        // Uncomment to use factory if available
        // LeaveType::factory()->count(10)->create();
    }
}
