<?php

namespace App\Modules\StockItem\Database\Seeders;



use App\Modules\StockCategory\Models\StockCategory;
use App\Modules\StockGroup\Models\StockGroup;
use App\Modules\StockItemBrand\Models\StockItemBrand;
use App\Modules\StockUnit\Models\StockUnit;
use App\Modules\UniqueQuantityCode\Models\UniqueQuantityCode;

use Illuminate\Database\Seeder;
use App\Modules\StockItem\Models\StockItem;

class StockItemSeeder extends Seeder
{
    public function run(): void
    {
        // Assuming related models (StockUnit, Uqc, Brand, StockCategory, StockGroup) are seeded or exist
        $stockUnit = StockUnit::where('code', 'MTS')->first() ?? StockUnit::create(['name' => 'MT']);
        $alternateStockUnit = StockUnit::where('name', 'Bags')->first() ?? StockUnit::create(['name' => 'Bags']);
        $uqc = UniqueQuantityCode::where('code', 'KGS')->first() ??
            UniqueQuantityCode::create(['code' => 'KGS', 'description' => 'Kilogram']);
        $brand = StockItemBrand::where('name', 'UltraTech')->first() ??
            StockItemBrand::create([
                'name' => 'UltraTech',
                'code' => 'UT',
                'description' => 'A leading brand of cement and construction materials by UltraTech Cement Limited',
                'status' => 'active',
                'icon' => 'FaCubes',
            ]);
        $stockCategory = StockCategory::where('name', 'Cement')->first() ?? StockCategory::create(['name' => 'Cement']);
        $stockGroup = StockGroup::where('name', 'Building Materials')->first() ?? StockGroup::create(['name' => 'Building Materials']);

        StockItem::create([
            'name' => 'UltraTech PPC',
            'code' => 'FPPUTHP1240000',
            'print_name' => 'UltraTech Portland Pozzolana Cement',
            'sku' => 'UTPPC001',
            'article_no' => null,
            'part_no' => null,
            'description' => 'Portland Pozzolana Cement (PPC) in HDPE/PP Pack',
            'stock_unit_id' => $stockUnit->id,
            'alternate_stock_unit_id' => $alternateStockUnit->id,
            'base_unit_value' => 1.0, // 1 MT
            'alternate_unit_value' => 20.0, // 20 Bags per MT (assuming 50 KG per bag)
            'unique_quantity_code_id' => $uqc->id,
            'type_of_supply' => 'goods',
            'is_negative_sales_allow' => false,
            'is_maintain_batch' => true,
            'is_maintain_serial' => false,
            'use_expiry_date' => false,
            'track_manufacturing_date' => false,
            'has_bom' => false,
            'is_finish_goods' => true,
            'is_raw_material' => false,
            'is_unfinished_goods' => false,
            'costing_method' => 'avg_cost',
            'market_valuation_method' => 'avg_price',
            'reorder_level' => 10.0,
            'minimum_stock' => 5.0,
            'maximum_stock' => 50.0,
            'is_sales_as_new_manufacture' => false,
            'is_purchase_as_consumed' => false,
            'is_rejection_as_scrap' => false,
            'is_gst_applicable' => true,
            'rate_of_duty' => 0.0, // No tax as per document
            'hsn_sac_code' => '25232930',
            'is_gst_inclusive' => false,
            'gst_type' => 'cgst_sgst',
            'stock_item_brand_id' => $brand->id,
            'stock_category_id' => $stockCategory->id,
            'stock_group_id' => $stockGroup->id,
            'mrp' => 550.00, // Estimated MRP per MT
            'standard_cost' => 5083.05, // As per document rate per MT
            'standard_selling_price' => 5083.05, // As per document rate per MT
            'icon' => null,
            'status' => 'active',
        ]);

        StockItem::create([
            "name"=> "Kidney Function Test (KFT)",
            "code"=> "LT-KFT-003",
            "print_name"=> "Kidney Function Test",
            "sku"=> "KFT003",
            "description"=> "Evaluates kidney performance by measuring creatinine, urea, and other waste levels in blood.",
            "stock_category_id"=> 7,
            "stock_group_id"=> 8,
            "stock_unit_id"=> 43,
            "alternate_stock_unit_id"=> 43,
            'unique_quantity_code_id' => $uqc->id,
            "base_unit_value"=> 1.0,
            "alternate_unit_value"=> 180.0,
            "type_of_supply"=> "goods",
            "is_negative_sales_allow"=> false,
            "is_maintain_batch"=> false,
            "is_maintain_serial"=> false,
            "use_expiry_date"=> false,
            "track_manufacturing_date"=> false,
            "is_finish_goods"=> false,
            "is_raw_material"=> false,
            "is_unfinished_goods"=> false,
            "costing_method"=> "avg_cost",
            "market_valuation_method"=> "avg_price",
            "reorder_level"=> 0,
            "minimum_stock"=> 4.0,
            "maximum_stock"=> 23.0,
            "is_gst_applicable"=> true,
            "gst_type"=> "cgst_sgst",
            "mrp"=> 500.00,
            "standard_cost" => 300.00,
            "standard_selling_price" => 500.00,
            'icon' => null,
            "status" => "active",
            "is_sample_required" => true
        ]);
        StockItem::create([
            "name"=> "Thyroid Function Test (TFT)",
            "code"=> "LT-TFT-004",
            "print_name"=> "Thyroid Function Test",
            "sku"=> "TFT004",
            "description"=> "Measures T3, T4, and TSH levels to assess thyroid gland functionality.",
            "stock_category_id"=> 7,
            "stock_group_id"=> 8,
            "stock_unit_id"=> 43,
            "alternate_stock_unit_id"=> 43,
            'unique_quantity_code_id' => $uqc->id,
            "base_unit_value"=> 1.0,
            "alternate_unit_value"=> 1.0,
            "type_of_supply"=> "goods",
            "is_negative_sales_allow"=> false,
            "is_maintain_batch"=> false,
            "is_maintain_serial"=> false,
            "use_expiry_date"=> false,
            "track_manufacturing_date"=> false,
            "is_finish_goods"=> false,
            "is_raw_material"=> false,
            "is_unfinished_goods"=> false,
            "costing_method"=> "avg_cost",
            "market_valuation_method"=> "avg_price",
            "reorder_level"=> 0,
            "minimum_stock"=> 5.0,
            "maximum_stock"=> 30.0,
            "is_gst_applicable"=> true,
            "gst_type"=> "cgst_sgst",
            "mrp"=> 450.00,
            "standard_cost" => 300.00,
            "standard_selling_price" => 450.00,
            'icon' => null,
            "status" => "active",
            "is_sample_required" => false
        ]);
        StockItem::create([
            "name" => "Lipid Profile Test",
            "code" => "LT-LIPID-005",
            "print_name" => "Lipid Profile",
            "sku" => "LIPID005",
            "description" => "Measures cholesterol and triglyceride levels to assess cardiovascular risk.",
            "stock_category_id" => 7,
            "stock_group_id" => 8,
            "stock_unit_id" => 43,
            "alternate_stock_unit_id" => 43,
            'unique_quantity_code_id' => $uqc->id,
            "base_unit_value" => 1.0,
            "alternate_unit_value" => 1.0,
            "type_of_supply" => "goods",
            "is_negative_sales_allow" => false,
            "is_maintain_batch" => false,
            "is_maintain_serial" => false,
            "use_expiry_date" => false,
            "track_manufacturing_date" => false,
            "is_finish_goods" => false,
            "is_raw_material" => false,
            "is_unfinished_goods" => false,
            "costing_method" => "avg_cost",
            "market_valuation_method" => "avg_price",
            "reorder_level" => 0,
            "minimum_stock" => 5.0,
            "maximum_stock" => 30.0,
            "is_gst_applicable" => true,
            "gst_type" => "cgst_sgst",
            "mrp" => 650.00,
            "standard_cost" => 450.00,
            "standard_selling_price" => 650.00,
            'icon' => null,
            "status" => "active",
            "is_sample_required" => false
        ]);

    }
}
