<?php

namespace App\Modules\DocumentUser\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\DocumentUser\Models\DocumentUser;

class DocumentUserSeeder extends Seeder
{
    public function run(): void
    {
        DocumentUser::create(['name' => 'Sample DocumentUser']);

        // Uncomment to use factory if available
        // DocumentUser::factory()->count(10)->create();
    }
}
