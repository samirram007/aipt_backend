<?php

namespace App\Modules\VoucherDispatchDetail\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\VoucherDispatchDetail\Models\VoucherDispatchDetail;

class VoucherDispatchDetailSeeder extends Seeder
{
    public function run(): void
    {
        VoucherDispatchDetail::create(['name' => 'Sample VoucherDispatchDetail']);

        // Uncomment to use factory if available
        // VoucherDispatchDetail::factory()->count(10)->create();
    }
}
