<?php

namespace App\Modules\Ward\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Ward\Models\Ward;

class WardSeeder extends Seeder
{
    public function run(): void
    {
        Ward::create(['name' => 'Sample Ward']);

        // Uncomment to use factory if available
        // Ward::factory()->count(10)->create();
    }
}
