<?php
namespace App\Modules\VoucherCategory\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\VoucherCategory\Models\VoucherCategory;


class VoucherCategorySeeder extends Seeder
{
    public function run(): void
    {
        $voucherCategories = [
            [
                'id' => 1,
                'name' => 'Accounting',
                'code' => 'ACC',
                'description' => 'Category for financial transactions, adjustments, and cash flow management',
                'module_link' => 'accounting',
                'status' => 'active',
                'icon' => 'FaCalculator', // React Icon name
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Inventory',
                'code' => 'INV',
                'description' => 'Category for stock movements, manufacturing, and physical stock adjustments',
                'module_link' => 'inventory',
                'status' => 'active',
                'icon' => 'FaBox', // React Icon name
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Statutory',
                'code' => 'STAT',
                'description' => 'Category for non-tax compliance transactions (e.g., Provident Fund, ESI)',
                'module_link' => 'statutory',
                'status' => 'active',
                'icon' => 'FaBalanceScale', // React Icon name
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Payroll',
                'code' => 'PAY',
                'description' => 'Category for employee-related payments, attendance, and benefits',
                'module_link' => 'payroll',
                'status' => 'active',
                'icon' => 'FaUsers', // React Icon name
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Order',
                'code' => 'ORD',
                'description' => 'Category for purchase orders, sales orders, and related pre-transaction documents',
                'module_link' => 'order',
                'status' => 'active',
                'icon' => 'FaShoppingCart', // React Icon name
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Assets',
                'code' => 'AST',
                'description' => 'Category for fixed asset acquisitions, disposals, and depreciation',
                'module_link' => 'assets',
                'status' => 'active',
                'icon' => 'FaTruck', // React Icon name
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Liabilities',
                'code' => 'LIAB',
                'description' => 'Category for loans, mortgages, and other liability-related transactions',
                'module_link' => 'liabilities',
                'status' => 'active',
                'icon' => 'FaMoneyBill', // React Icon name
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Expenses',
                'code' => 'EXP',
                'description' => 'Category for operational expenses (e.g., rent, utilities, marketing)',
                'module_link' => 'expenses',
                'status' => 'active',
                'icon' => 'FaBuilding', // React Icon name
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'name' => 'Tax',
                'code' => 'TAX',
                'description' => 'Category for tax-related transactions (e.g., GST, TDS, TCS, Advance Tax)',
                'module_link' => 'tax',
                'status' => 'active',
                'icon' => 'FaFileInvoiceDollar', // React Icon name
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        foreach ($voucherCategories as $category) {
            VoucherCategory::updateOrCreate(
                ['id' => $category['id']],
                $category
            );
        }


    }
}
