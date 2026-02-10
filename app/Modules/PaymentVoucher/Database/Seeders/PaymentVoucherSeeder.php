<?php

namespace App\Modules\PaymentVoucher\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PaymentVoucher\Models\PaymentVoucher;

class PaymentVoucherSeeder extends Seeder
{
    public function run(): void
    {
        PaymentVoucher::create(['name' => 'Sample PaymentVoucher']);

        // Uncomment to use factory if available
        // PaymentVoucher::factory()->count(10)->create();
    }
}
