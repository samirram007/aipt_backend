<?php

namespace App\Modules\FacilityCapitalItem\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\FacilityCapitalItem\Models\FacilityCapitalItem;

class FacilityCapitalItemSeeder extends Seeder
{
    public function run(): void
    {
        FacilityCapitalItem::create(['name' => 'Sample FacilityCapitalItem']);

        // Uncomment to use factory if available
        // FacilityCapitalItem::factory()->count(10)->create();
    }
}
