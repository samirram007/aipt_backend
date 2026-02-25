<?php

namespace App\Modules\Voucher\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Support\Facades\DB;


class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        $entries = [
            // ---------------- Purchase GRN ----------------
            [
                'voucher_id' => 1, // PUR-0001
                'entry_order' => 1,
                'account_ledger_id' => 12, // Raw Material Purchases
                'debit' => 5000,
                'credit' => null,
                'remarks' => 'Raw material purchase',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'voucher_id' => 1,
                'entry_order' => 2,
                'account_ledger_id' => 8, // Vendor Y Payable
                'debit' => null,
                'credit' => 5000,
                'remarks' => 'Payable to Vendor Y',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ---------------- Sales Dispatch ----------------
            [
                'voucher_id' => 2, // SAL-0001
                'entry_order' => 1,
                'account_ledger_id' => 3, // Customer A Receivable
                'debit' => 8000,
                'credit' => null,
                'remarks' => 'Customer A invoice',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'voucher_id' => 2,
                'entry_order' => 2,
                'account_ledger_id' => 9, // Product Sales
                'debit' => null,
                'credit' => 8000,
                'remarks' => 'Sales revenue',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ---------------- Issue to Production ----------------
            [
                'voucher_id' => 3, // PROD-0001
                'entry_order' => 1,
                'account_ledger_id' => 15, // Raw Material Inventory
                'debit' => null,
                'credit' => 3000,
                'remarks' => 'Raw materials issued to production',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'voucher_id' => 3,
                'entry_order' => 2,
                'account_ledger_id' => 19, // Production Overheads / WIP
                'debit' => 3000,
                'credit' => null,
                'remarks' => 'WIP inventory debit',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ---------------- Finished Goods Production ----------------
            [
                'voucher_id' => 3, // Same production cycle, finished output
                'entry_order' => 3,
                'account_ledger_id' => 17, // Finished Goods Inventory
                'debit' => 4500,
                'credit' => null,
                'remarks' => 'Finished goods capitalized',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'voucher_id' => 3,
                'entry_order' => 4,
                'account_ledger_id' => 19, // Production Overheads / WIP
                'debit' => null,
                'credit' => 4500,
                'remarks' => 'WIP cleared',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ---------------- Stock Adjustment ----------------
            [
                'voucher_id' => 4, // ADJ-0001
                'entry_order' => 1,
                'account_ledger_id' => 17, // Finished Goods Inventory
                'debit' => 1000,
                'credit' => null,
                'remarks' => 'Stock adjustment (gain)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'voucher_id' => 4,
                'entry_order' => 2,
                'account_ledger_id' => 20, // Rent Expense (dummy expense account for adj loss/gain)
                'debit' => null,
                'credit' => 1000,
                'remarks' => 'Adjustment offset',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('voucher_entries')->insert($entries);
    }
}


