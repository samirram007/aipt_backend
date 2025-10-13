<?php

namespace App\Modules\EmployeeGroup\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\EmployeeGroup\Models\EmployeeGroup;

class EmployeeGroupSeeder extends Seeder
{
    public function run(): void
    {
        EmployeeGroup::create(['id' => '101', 'name' => 'Primary', 'code' => 'PRI', 'status' => 'active']);

        // Uncomment to use factory if available
        // EmployeeGroup::factory()->count(10)->create();
    }
}
