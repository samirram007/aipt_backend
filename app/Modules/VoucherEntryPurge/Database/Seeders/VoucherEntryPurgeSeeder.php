<?php

namespace App\Modules\VoucherEntryPurge\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\VoucherEntryPurge\Models\VoucherEntryPurge;

class VoucherEntryPurgeSeeder extends Seeder
{
    public function run(): void
    {
        VoucherEntryPurge::create(['name' => 'Sample VoucherEntryPurge']);

        // Uncomment to use factory if available
        // VoucherEntryPurge::factory()->count(10)->create();
    }
}
