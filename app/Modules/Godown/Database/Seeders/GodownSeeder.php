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
            'address' => [
                'street' => '123 Main Street',
                'city' => 'Kolkata',
                'state' => 'West Bengal',
                'pincode' => '700001',
            ],
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
            'address' => [
                'street' => '45 Industrial Area',
                'city' => 'Kolkata',
                'state' => 'West Bengal',
                'pincode' => '700002',
            ],
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
            'address' => [
                'street' => '67 Export Hub',
                'city' => 'Kolkata',
                'state' => 'West Bengal',
                'pincode' => '700003',
            ],
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
            'address' => [
                'street' => '89 Logistics Park',
                'city' => 'Howrah',
                'state' => 'West Bengal',
                'pincode' => '711101',
            ],
        ]);
    }
}
