<?php

namespace App\Modules\VoucherNo\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\VoucherNo\Models\VoucherNo;

class VoucherNoSeeder extends Seeder
{
    public function run(): void
    {
        VoucherNo::create(['name' => 'Sample VoucherNo']);

        // Uncomment to use factory if available
        // VoucherNo::factory()->count(10)->create();
    }
}
