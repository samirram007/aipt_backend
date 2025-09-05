<?php

namespace App\Modules\Godown\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Godown\Models\Godown;

class GodownSeeder extends Seeder
{
    public function run(): void
    {
        Godown::create(['name' => 'Sample Godown']);

        // Uncomment to use factory if available
        // Godown::factory()->count(10)->create();
    }
}
