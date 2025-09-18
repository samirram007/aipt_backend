<?php

namespace App\Modules\StockCategory\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockCategory\Models\StockCategory;
use Illuminate\Support\Facades\DB;

class StockCategorySeeder extends Seeder
{
    public function run(): void
    {
        // StockCategory::create(['name' => 'Sample StockCategory']);
        DB::table('stock_categories')->insert([
            [
                'id' => 1,
                'name' => 'Electronics',
                'code' => 'ELEC',
                'parent_id' => null,
                'description' => 'Electronic devices and gadgets',
                'status' => 'active',
                'icon' => 'lucide-tv', // React Icon name (e.g., from lucide-react)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Furniture',
                'code' => 'FURN',
                'parent_id' => null,
                'description' => 'Home and office furniture',
                'status' => 'active',
                'icon' => 'lucide-chair',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Mobiles',
                'code' => 'MOB',
                'parent_id' => 1, // child of Electronics
                'description' => 'Smartphones and accessories',
                'status' => 'active',
                'icon' => 'lucide-smartphone',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Laptops',
                'code' => 'LAP',
                'parent_id' => 1,
                'description' => 'Laptops and notebooks',
                'status' => 'active',
                'icon' => 'lucide-laptop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Tables',
                'code' => 'TAB',
                'parent_id' => 2,
                'description' => 'Dining tables, office tables',
                'status' => 'active',
                'icon' => 'lucide-table',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Chairs',
                'code' => 'CHR',
                'parent_id' => 2,
                'description' => 'Office chairs, gaming chairs',
                'status' => 'active',
                'icon' => 'lucide-armchair',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
