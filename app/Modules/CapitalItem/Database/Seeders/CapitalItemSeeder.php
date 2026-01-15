<?php

namespace App\Modules\CapitalItem\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\CapitalItem\Models\CapitalItem;

class CapitalItemSeeder extends Seeder
{
    public function run(): void
    {
        CapitalItem::create(['name' => 'Sample CapitalItem']);

        // Uncomment to use factory if available
        // CapitalItem::factory()->count(10)->create();
    }
}
