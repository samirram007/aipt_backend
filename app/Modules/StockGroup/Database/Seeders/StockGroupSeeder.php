<?php

namespace App\Modules\StockGroup\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockGroup\Models\StockGroup;
use Illuminate\Support\Facades\DB;

class StockGroupSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stock_groups')->insert([
            [
                'id' => 1,
                'name' => 'Primary',
                'code' => 'PRI',
                'description' => 'Top level stock group',
                'status' => 'active',
                'icon' => 'lucide-layers',
                'parent_id' => null,
                'should_quantities_of_items_be_added' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Raw Materials',
                'code' => 'RAW',
                'description' => 'Base materials used for production',
                'status' => 'active',
                'icon' => 'lucide-cube',
                'parent_id' => 1,
                'should_quantities_of_items_be_added' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Finished Goods',
                'code' => 'FG',
                'description' => 'Manufactured finished products',
                'status' => 'active',
                'icon' => 'lucide-package',
                'parent_id' => 1,
                'should_quantities_of_items_be_added' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Consumables',
                'code' => 'CON',
                'description' => 'Items consumed during production',
                'status' => 'active',
                'icon' => 'lucide-droplet',
                'parent_id' => 1,
                'should_quantities_of_items_be_added' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Electronics',
                'code' => 'ELEC',
                'description' => 'Electronic finished goods',
                'status' => 'active',
                'icon' => 'lucide-tv',
                'parent_id' => 3, // under Finished Goods
                'should_quantities_of_items_be_added' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Mobiles',
                'code' => 'MOB',
                'description' => 'Mobile phones',
                'status' => 'active',
                'icon' => 'lucide-smartphone',
                'parent_id' => 5,
                'should_quantities_of_items_be_added' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Laptops',
                'code' => 'LAP',
                'description' => 'Laptops and notebooks',
                'status' => 'active',
                'icon' => 'lucide-laptop',
                'parent_id' => 5,
                'should_quantities_of_items_be_added' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
