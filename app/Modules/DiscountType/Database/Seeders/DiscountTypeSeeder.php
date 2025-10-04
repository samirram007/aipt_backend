<?php

namespace App\Modules\DiscountType\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\DiscountType\Models\DiscountType;

class DiscountTypeSeeder extends Seeder
{
    public function run(): void
    {
        DiscountType::create(['name' => 'Sample DiscountType']);

        // Uncomment to use factory if available
        // DiscountType::factory()->count(10)->create();
    }
}
