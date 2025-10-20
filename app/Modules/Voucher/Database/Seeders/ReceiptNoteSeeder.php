<?php

namespace App\Modules\Voucher\Database\Seeders;

use App\Modules\Voucher\Models\Voucher;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use Illuminate\Database\Seeder;

use Carbon\Carbon;

class ReceiptNoteSeeder extends Seeder
{
    public function run(): void
    {
        // 🧾 Create Receipt Note Voucher
        $voucher = Voucher::create([
            'voucher_no' => 'RN-1001',
            'voucher_date' => Carbon::now(),
            'reference_no' => 'PO-5001',
            'reference_date' => Carbon::now(),
            'voucher_type_id' => 2002, // Receipt Note Type ID
            'is_effecting' => true,
            'effects_account' => true,
            'effects_stock' => true,
            'remarks' => 'Goods received from vendor before invoice',
            'status' => 'active',
            'fiscal_year_id' => 2025,
            'company_id' => 1,
        ]);

        // ⚙️ Example Ledger IDs
        $grnLedgerId = 3000001;    // Goods Received Not Invoiced (Liability)
        $inventoryLedgerId = 5000001; // Inventory / Stock Account

        // 🧮 Voucher Entries

        // 1️⃣ Debit: Inventory Account (goods increase)
        VoucherEntry::create([
            'voucher_id' => $voucher->id,
            'entry_order' => 1,
            'account_ledger_id' => $inventoryLedgerId,
            'debit' => 8000.00,
            'credit' => 0,
            'remarks' => 'Goods received into inventory',
        ]);

        // 2️⃣ Credit: GRNI (Goods Received Not Invoiced)
        VoucherEntry::create([
            'voucher_id' => $voucher->id,
            'entry_order' => 2,
            'account_ledger_id' => $grnLedgerId,
            'debit' => 0,
            'credit' => 8000.00,
            'remarks' => 'Liability until purchase invoice',
        ]);
    }
}
