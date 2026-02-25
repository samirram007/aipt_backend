<?php

namespace App\Modules\Department\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Department\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::create(['id' => '101', 'name' => 'Primary', 'code' => 'PRI', 'status' => 'active']);

        // Uncomment to use factory if available
        // Department::factory()->count(10)->create();
    }
}
