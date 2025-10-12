<?php

namespace App\Modules\Grade\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Grade\Models\Grade;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        Grade::create(['name' => 'Sample Grade']);

        // Uncomment to use factory if available
        // Grade::factory()->count(10)->create();
    }
}
