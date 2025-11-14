<?php

namespace App\Modules\Branch\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Branch\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branch::create(['name' => 'Sample Branch']);

        // Uncomment to use factory if available
        // Branch::factory()->count(10)->create();
    }
}
