<?php

namespace App\Modules\Grade\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Grade\Models\Grade;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        Grade::create(['id' => '101', 'name' => 'Primary', 'code' => 'PRI', 'status' => 'active']);

        // Uncomment to use factory if available
        // Grade::factory()->count(10)->create();
    }
}
