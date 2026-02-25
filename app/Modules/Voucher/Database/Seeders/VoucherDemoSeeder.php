<?php

namespace App\Modules\Voucher\Database\Seeders;

use App\Modules\Voucher\Models\Voucher;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use Illuminate\Database\Seeder;


class VoucherDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Create a demo voucher
        $voucher = Voucher::create([
            'voucher_no' => 'PV-1001',
            'voucher_date' => now(),
            'reference_no' => 'PO-5001',
            'reference_date' => now(),
            'voucher_type_id' => 1005, // Purchase voucher type
            'is_effecting' => true,
            'effects_account' => true,
            'effects_stock' => true,
            'remarks' => 'Purchase of materials',
            'status' => 'active',
            'fiscal_year_id' => 2025,
            'company_id' => 1,
        ]);

        // Ledger IDs from your example
        $creditorLedgerId = 2000001; // Accounts Payable
        $purchaseLedgerId = 4000001; // Purchase Account

        // Create voucher entries

        // 1️⃣ Debit: Purchase Account
        VoucherEntry::create([
            'voucher_id' => $voucher->id,
            'entry_order' => 1,
            'account_ledger_id' => $purchaseLedgerId,
            'debit' => 5000.00,
            'credit' => 0,
            'remarks' => 'Purchase of goods',
        ]);

        // 2️⃣ Credit: Accounts Payable (Vendor)
        VoucherEntry::create([
            'voucher_id' => $voucher->id,
            'entry_order' => 2,
            'account_ledger_id' => $creditorLedgerId,
            'debit' => 0,
            'credit' => 5000.00,
            'remarks' => 'Payable to vendor',
        ]);
    }
}
