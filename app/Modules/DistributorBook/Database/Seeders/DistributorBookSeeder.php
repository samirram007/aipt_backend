<?php

namespace App\Modules\DistributorBook\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\DistributorBook\Models\DistributorBook;

class DistributorBookSeeder extends Seeder
{
    public function run(): void
    {
        DistributorBook::create(['name' => 'Sample DistributorBook']);

        // Uncomment to use factory if available
        // DistributorBook::factory()->count(10)->create();
    }
}
