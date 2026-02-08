<?php

namespace App\Modules\Bom\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Bom\Models\Bom;

class BomSeeder extends Seeder
{
    public function run(): void
    {
        Bom::create(['name' => 'Sample Bom']);

        // Uncomment to use factory if available
        // Bom::factory()->count(10)->create();
    }
}
