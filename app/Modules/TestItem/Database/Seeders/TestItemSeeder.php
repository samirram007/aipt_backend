<?php

namespace App\Modules\TestItem\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\TestItem\Models\TestItem;

class TestItemSeeder extends Seeder
{
    public function run(): void
    {
        TestItem::create(['name' => 'Sample TestItem']);

        // Uncomment to use factory if available
        // TestItem::factory()->count(10)->create();
    }
}
