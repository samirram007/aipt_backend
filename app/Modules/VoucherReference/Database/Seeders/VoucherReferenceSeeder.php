<?php

namespace App\Modules\VoucherReference\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\VoucherReference\Models\VoucherReference;

class VoucherReferenceSeeder extends Seeder
{
    public function run(): void
    {
        VoucherReference::create(['name' => 'Sample VoucherReference']);

        // Uncomment to use factory if available
        // VoucherReference::factory()->count(10)->create();
    }
}
