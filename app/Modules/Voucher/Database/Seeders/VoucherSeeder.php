<?php

namespace App\Modules\Voucher\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Voucher\Models\Voucher;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        Voucher::create(['name' => 'Sample Voucher']);

        // Uncomment to use factory if available
        // Voucher::factory()->count(10)->create();
    }
}
