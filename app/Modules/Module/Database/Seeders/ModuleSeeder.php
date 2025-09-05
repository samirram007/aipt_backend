<?php

namespace App\Modules\Module\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Module\Models\Module;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        Module::create(['name' => 'Sample Module']);

        // Uncomment to use factory if available
        // Module::factory()->count(10)->create();
    }
}
