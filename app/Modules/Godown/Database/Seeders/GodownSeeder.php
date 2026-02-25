<?php

namespace App\Modules\Godown\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Godown\Models\Godown;

class GodownSeeder extends Seeder
{
    public function run(): void
    {
        $mainGodown = Godown::create([
            'name' => 'Main Godown',
            'code' => 'GD-001',
            'parent_id' => null,
            'description' => 'Central storage godown',
            'status' => 'active',
            'icon' => 'warehouse',
            'our_stock_with_third_party' => false,
            'third_party_stock_with_us' => false,
        ]);

        // Child Godowns
        Godown::create([
            'name' => 'Spare Parts Godown',
            'code' => 'GD-002',
            'parent_id' => $mainGodown->id,
            'description' => 'Storage for spare parts and accessories',
            'status' => 'active',
            'icon' => 'cog',
            'our_stock_with_third_party' => false,
            'third_party_stock_with_us' => false,
        ]);

        Godown::create([
            'name' => 'Finished Goods Godown',
            'code' => 'GD-003',
            'parent_id' => $mainGodown->id,
            'description' => 'Storage for finished products',
            'status' => 'active',
            'icon' => 'box',
            'our_stock_with_third_party' => false,
            'third_party_stock_with_us' => true,
        ]);

        Godown::create([
            'name' => 'Third Party Warehouse',
            'code' => 'GD-004',
            'parent_id' => null, // Independent godown
            'description' => 'Warehouse managed by third party',
            'status' => 'active',
            'icon' => 'truck',
            'our_stock_with_third_party' => true,
            'third_party_stock_with_us' => false,
        ]);
    }
}
