<?php

namespace App\Modules\AppModule\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AppModule\Models\AppModule;

class AppModuleSeeder extends Seeder
{
    public function run(): void
    {
        AppModule::create(['name' => 'Sample AppModule']);

        // Uncomment to use factory if available
        // AppModule::factory()->count(10)->create();
    }
}
