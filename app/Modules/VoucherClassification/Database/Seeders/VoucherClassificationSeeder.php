<?php

namespace App\Modules\VoucherClassification\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use App\Modules\VoucherClassification\Models\VoucherClassification;

class VoucherClassificationSeeder extends Seeder
{
    public function run(): void
    {
        // VoucherClassification::create(['name' => 'Sample VoucherClassification']);

        DB::table('voucher_classifications')->insert([
            // For Payment Voucher
            [
                'name' => 'Simple',
                'code' => 'SIM',
                'voucher_type_id' => 1, // Payment Voucher
                'rules' => json_encode(['default_ledger' => 'Cash/Bank']),
                'description' => 'Single debit, single credit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Compound',
                'code' => 'COM',
                'voucher_type_id' => 1, // Payment Voucher
                'rules' => json_encode(['multiple_credits' => true]),
                'description' => 'Multiple debits or credits',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // For Purchase Voucher
            [
                'name' => 'Primary',
                'code' => 'PRI',
                'voucher_type_id' => 3, // Purchase Voucher
                'rules' => json_encode(['tax_rate' => 18]), // GST example
                'description' => 'Main document (e.g., challan)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Collateral',
                'code' => 'COL',
                'voucher_type_id' => 3, // Purchase Voucher
                'rules' => json_encode(['supporting_doc' => true]),
                'description' => 'Supporting document (e.g., RAKE-LOADING SLIP)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // For Delivery Voucher
            [
                'name' => 'Simple Delivery',
                'code' => 'SID',
                'voucher_type_id' => 4, // Delivery Voucher
                'rules' => json_encode(['default_ledger' => 'Accounts Receivable']),
                'description' => 'Single debit, single credit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'GST Class',
                'code' => 'GST',
                'voucher_type_id' => 4, // Delivery Voucher
                'rules' => json_encode(['tax_rate' => 18]),
                'description' => 'With GST application',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
