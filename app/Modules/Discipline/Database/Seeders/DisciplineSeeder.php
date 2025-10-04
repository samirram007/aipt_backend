<?php

namespace App\Modules\Discipline\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Discipline\Models\Discipline;

class DisciplineSeeder extends Seeder
{
    public function run(): void
    {
        Discipline::create(['name' => 'Sample Discipline']);

        // Uncomment to use factory if available
        // Discipline::factory()->count(10)->create();
    }
}
