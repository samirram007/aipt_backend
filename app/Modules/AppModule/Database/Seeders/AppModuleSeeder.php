<?php

namespace App\Modules\AppModule\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AppModule\Models\AppModule;

class AppModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            [
                'id' => 10000,
                'name' => 'User Management',
                'code' => 'USER_MGMT',
                'description' => 'Manage users, roles, and permissions',
                'status' => 'active',
                'icon' => 'users',
            ],
            [
                'id' => 10001,
                'name' => 'Finance',
                'code' => 'FINANCE',
                'description' => 'Handles financial transactions, invoices, and ledgers',
                'status' => 'active',
                'icon' => 'wallet',
            ],
            [
                'id' => 10002,
                'name' => 'Inventory',
                'code' => 'INVENTORY',
                'description' => 'Manages stock items, batches, and warehouse data',
                'status' => 'active',
                'icon' => 'boxes',
            ],
            [
                'id' => 10003,
                'name' => 'Sales',
                'code' => 'SALES',
                'description' => 'Sales orders, customers, and billing operations',
                'status' => 'active',
                'icon' => 'shopping-cart',
            ],
            [
                'id' => 10004,
                'name' => 'Purchase',
                'code' => 'PURCHASE',
                'description' => 'Supplier management and purchase order tracking',
                'status' => 'active',
                'icon' => 'shopping-bag',
            ],
            [
                'id' => 10005,
                'name' => 'Reports',
                'code' => 'REPORTS',
                'description' => 'System-wide reporting and analytics',
                'status' => 'active',
                'icon' => 'bar-chart',
            ],
        ];

        foreach ($modules as $module) {
            AppModule::updateOrCreate(
                ['id' => $module['id']],
                $module
            );
        }
    }
}
