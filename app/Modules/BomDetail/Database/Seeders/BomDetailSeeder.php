<?php

namespace App\Modules\BomDetail\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\BomDetail\Models\BomDetail;

class BomDetailSeeder extends Seeder
{
    public function run(): void
    {
        BomDetail::create(['name' => 'Sample BomDetail']);

        // Uncomment to use factory if available
        // BomDetail::factory()->count(10)->create();
    }
}
