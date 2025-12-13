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

        // StockItem::create([
        //     'name' => 'UltraTech PPC',
        //     'code' => 'FPPUTHP1240000',
        //     'print_name' => 'UltraTech Portland Pozzolana Cement',
        //     'sku' => 'UTPPC001',
        //     'article_no' => null,
        //     'part_no' => null,
        //     'description' => 'Portland Pozzolana Cement (PPC) in HDPE/PP Pack',
        //     'stock_unit_id' => $stockUnit->id,
        //     'alternate_stock_unit_id' => $alternateStockUnit->id,
        //     'base_unit_value' => 1.0, // 1 MT
        //     'alternate_unit_value' => 20.0, // 20 Bags per MT (assuming 50 KG per bag)
        //     'unique_quantity_code_id' => $uqc->id,
        //     'type_of_supply' => 'goods',
        //     'is_negative_sales_allow' => false,
        //     'is_maintain_batch' => true,
        //     'is_maintain_serial' => false,
        //     'use_expiry_date' => false,
        //     'track_manufacturing_date' => false,
        //     'has_bom' => false,
        //     'is_finish_goods' => true,
        //     'is_raw_material' => false,
        //     'is_unfinished_goods' => false,
        //     'costing_method' => 'avg_cost',
        //     'market_valuation_method' => 'avg_price',
        //     'reorder_level' => 10.0,
        //     'minimum_stock' => 5.0,
        //     'maximum_stock' => 50.0,
        //     'is_sales_as_new_manufacture' => false,
        //     'is_purchase_as_consumed' => false,
        //     'is_rejection_as_scrap' => false,
        //     'is_gst_applicable' => true,
        //     'rate_of_duty' => 0.0, // No tax as per document
        //     'hsn_sac_code' => '25232930',
        //     'is_gst_inclusive' => false,
        //     'gst_type' => 'cgst_sgst',
        //     'stock_item_brand_id' => $brand->id,
        //     'stock_category_id' => $stockCategory->id,
        //     'stock_group_id' => $stockGroup->id,
        //     'mrp' => 550.00, // Estimated MRP per MT
        //     'standard_cost' => 5083.05, // As per document rate per MT
        //     'standard_selling_price' => 5083.05, // As per document rate per MT
        //     'icon' => null,
        //     'status' => 'active',
        // ]);


        // 🔹 Biochemistry Category (Category ID: 7)
        StockItem::insert([
            [
                "name" => "Complete Blood Count (CBC)",
                "code" => "HM-CBC-001",
                "print_name" => "CBC",
                "sku" => "CBC001",
                "description" => "Measures different components of blood such as RBC, WBC, and platelets.",
                "stock_category_id" => 2, // Hematology
                "stock_group_id" => 4,    // CBC group
                "department_id" => 104,   // Hematology Department
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
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
                "maximum_stock" => 15.0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 250.00,
                "standard_cost" => 100.00,
                "standard_selling_price" => 250.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => true
            ],
            [
                "name" => "Liver Function Test (LFT)",
                "code" => "BC-LFT-001",
                "print_name" => "LFT",
                "sku" => "LFT001",
                "description" => "Measures liver enzymes, proteins, and bilirubin levels.",
                "stock_category_id" => 1, // Biochemistry
                "stock_group_id" => 2,    // LFT
                "department_id" => 102,   // Biochemistry Department
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
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
                "minimum_stock" => 2.0,
                "maximum_stock" => 10.0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 450.00,
                "standard_cost" => 220.00,
                "standard_selling_price" => 450.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => true
            ],
            [
                "name" => "Kidney Function Test (KFT)",
                "code" => "BC-KFT-001",
                "print_name" => "KFT",
                "sku" => "KFT001",
                "description" => "Evaluates kidney function by measuring urea, creatinine, and uric acid.",
                "stock_category_id" => 1, // Biochemistry
                "stock_group_id" => 3,    // KFT
                "department_id" => 102,   // Biochemistry Department
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
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
                "minimum_stock" => 3.0,
                "maximum_stock" => 12.0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 400.00,
                "standard_cost" => 200.00,
                "standard_selling_price" => 400.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => true
            ],
            [
                "name" => "Thyroid Profile",
                "code" => "IM-THY-001",
                "print_name" => "Thyroid Profile",
                "sku" => "THY001",
                "description" => "Measures levels of T3, T4, and TSH hormones to assess thyroid function.",
                "stock_category_id" => 4, // Immunology
                "stock_group_id" => 8,    // Thyroid Profile
                "department_id" => 107,   // Immunology Department
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
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
                "minimum_stock" => 2.0,
                "maximum_stock" => 8.0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 500.00,
                "standard_cost" => 280.00,
                "standard_selling_price" => 500.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => false
            ],
            [
                "name" => "Urine Culture",
                "code" => "MB-URC-001",
                "print_name" => "Urine Culture",
                "sku" => "URC001",
                "description" => "Detects bacteria or yeast in a urine sample to diagnose infections.",
                "stock_category_id" => 3, // Microbiology
                "stock_group_id" => 6,    // Urine Culture
                "department_id" => 103,   // Microbiology Department
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
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
                "minimum_stock" => 1.0,
                "maximum_stock" => 6.0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 300.00,
                "standard_cost" => 150.00,
                "standard_selling_price" => 300.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => true
            ]
        ]);

        StockItem::insert([
            [
                "name" => "Blood Sugar (Fasting)",
                "code" => "BC-BS-F-001",
                "print_name" => "Blood Sugar Fasting",
                "sku" => "BSF001",
                "description" => "Measures glucose levels in blood after fasting to screen for diabetes.",
                "stock_category_id" => 1, // Biochemistry
                "stock_group_id" => 1,    // Blood Sugar group
                "department_id" => 102,   // Biochemistry
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
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
                "minimum_stock" => 4.0,
                "maximum_stock" => 10.0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 120.00,
                "standard_cost" => 60.00,
                "standard_selling_price" => 120.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => true
            ],
            [
                "name" => "Lipid Profile",
                "code" => "BC-LIP-001",
                "print_name" => "Lipid Profile",
                "sku" => "LIP001",
                "description" => "Assesses cholesterol and triglyceride levels to evaluate heart disease risk.",
                "stock_category_id" => 1, // Biochemistry
                "stock_group_id" => 5,    // Lipid Profile
                "department_id" => 102,   // Biochemistry
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
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
                "minimum_stock" => 3.0,
                "maximum_stock" => 9.0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 500.00,
                "standard_cost" => 250.00,
                "standard_selling_price" => 500.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => true
            ],
            [
                "name" => "Widal Test",
                "code" => "MB-WID-001",
                "print_name" => "Widal Test",
                "sku" => "WID001",
                "description" => "Detects antibodies in blood to diagnose typhoid fever.",
                "stock_category_id" => 3, // Microbiology
                "stock_group_id" => 7,    // Widal
                "department_id" => 103,   // Microbiology
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
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
                "minimum_stock" => 2.0,
                "maximum_stock" => 8.0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 300.00,
                "standard_cost" => 140.00,
                "standard_selling_price" => 300.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => true
            ],
            [
                "name" => "Malaria Parasite Test",
                "code" => "MB-MP-001",
                "print_name" => "MP Test",
                "sku" => "MP001",
                "description" => "Detects the presence of malaria parasites in blood samples.",
                "stock_category_id" => 3, // Microbiology
                "stock_group_id" => 9,    // Malaria Group
                "department_id" => 103,   // Microbiology
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
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
                "minimum_stock" => 2.0,
                "maximum_stock" => 10.0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 200.00,
                "standard_cost" => 90.00,
                "standard_selling_price" => 200.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => true
            ],
            [
                "name" => "Chest X-Ray",
                "code" => "RD-CXR-001",
                "print_name" => "Chest X-Ray",
                "sku" => "CXR001",
                "description" => "Produces images of the chest to evaluate lungs, heart, and chest wall.",
                "stock_category_id" => 5, // Radiology
                "stock_group_id" => 11,   // X-Ray
                "department_id" => 106,   // Radiology
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
                "type_of_supply" => "services",
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
                "minimum_stock" => 0,
                "maximum_stock" => 0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 350.00,
                "standard_cost" => 180.00,
                "standard_selling_price" => 350.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => false
            ],
            [
                "name" => "Vitamin D Test",
                "code" => "IM-VITD-001",
                "print_name" => "Vitamin D Test",
                "sku" => "VITD001",
                "description" => "Measures the level of Vitamin D in blood to assess bone and immune health.",
                "stock_category_id" => 4, // Immunology
                "stock_group_id" => 12,   // Vitamin Tests
                "department_id" => 107,   // Immunology
                "stock_unit_id" => 43,
                "alternate_stock_unit_id" => 43,
                'unique_quantity_code_id' => $uqc->id,
                "base_unit_value" => 1.0,
                "alternate_unit_value" => 180.0,
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
                "minimum_stock" => 2.0,
                "maximum_stock" => 7.0,
                "is_gst_applicable" => true,
                "gst_type" => "cgst_sgst",
                "mrp" => 800.00,
                "standard_cost" => 450.00,
                "standard_selling_price" => 800.00,
                'icon' => null,
                "status" => "active",
                "is_sample_required" => true
            ]
        ]);
    }
}
