<?php

namespace App\Modules\Transporter\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Transporter\Models\Transporter;

class TransporterSeeder extends Seeder
{
    public function run(): void
    {
        Transporter::create(['name' => 'Sample Transporter']);

        // Uncomment to use factory if available
        // Transporter::factory()->count(10)->create();
    }
}
