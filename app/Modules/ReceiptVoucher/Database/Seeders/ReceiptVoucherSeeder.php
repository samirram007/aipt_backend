<?php

namespace App\Modules\ReceiptVoucher\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\ReceiptVoucher\Models\ReceiptVoucher;

class ReceiptVoucherSeeder extends Seeder
{
    public function run(): void
    {
        ReceiptVoucher::create(['name' => 'Sample ReceiptVoucher']);

        // Uncomment to use factory if available
        // ReceiptVoucher::factory()->count(10)->create();
    }
}
