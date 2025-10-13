<?php

namespace App\Modules\AppModuleFeature\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AppModuleFeature\Models\AppModuleFeature;

class AppModuleFeatureSeeder extends Seeder
{
    public function run(): void
    {
        AppModuleFeature::create(['name' => 'Sample AppModuleFeature']);

        // Uncomment to use factory if available
        // AppModuleFeature::factory()->count(10)->create();
    }
}
