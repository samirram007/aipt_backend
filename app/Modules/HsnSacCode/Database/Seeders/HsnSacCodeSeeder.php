<?php

namespace App\Modules\HsnSacCode\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\HsnSacCode\Models\HsnSacCode;

class HsnSacCodeSeeder extends Seeder
{
    public function run(): void
    {
        HsnSacCode::create(['name' => 'Sample HsnSacCode']);

        // Uncomment to use factory if available
        // HsnSacCode::factory()->count(10)->create();
    }
}
