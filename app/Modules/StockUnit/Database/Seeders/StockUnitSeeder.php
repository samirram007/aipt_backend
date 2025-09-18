<?php

namespace App\Modules\StockUnit\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockUnit\Models\StockUnit;
use Illuminate\Support\Facades\DB;

class StockUnitSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stock_units')->insert([
            ['name' => 'Meter', 'code' => 'm', 'unit_type' => 'simple', 'quantity_type' => 'length', 'description' => 'SI base unit of length', 'status' => 'active', 'icon' => 'FaRuler', 'uqc_id' => null, 'primary_stock_unit_id' => null, 'secondary_stock_unit_id' => null, 'conversion_factor' => null, 'created_at' => now(), 'updated_at' => now(), 'no_of_decimal_places' => 2],
            ['name' => 'Kilometer', 'code' => 'km', 'unit_type' => 'simple', 'quantity_type' => 'length', 'description' => '1000 meters', 'status' => 'active', 'icon' => 'FaRuler', 'uqc_id' => null, 'primary_stock_unit_id' => null, 'secondary_stock_unit_id' => null, 'conversion_factor' => null, 'created_at' => now(), 'updated_at' => now(), 'no_of_decimal_places' => 2],
            ['name' => 'Centimeter', 'code' => 'cm', 'unit_type' => 'simple', 'quantity_type' => 'length', 'description' => '0.01 meters', 'status' => 'active', 'icon' => 'FaRuler', 'uqc_id' => null, 'primary_stock_unit_id' => null, 'secondary_stock_unit_id' => null, 'conversion_factor' => null, 'created_at' => now(), 'updated_at' => now(), 'no_of_decimal_places' => 2],
            ['name' => 'Square Meter', 'code' => 'm²', 'unit_type' => 'simple', 'quantity_type' => 'area', 'description' => 'Derived unit of area', 'status' => 'active', 'icon' => 'FaShapes', 'uqc_id' => null, 'primary_stock_unit_id' => null, 'secondary_stock_unit_id' => null, 'conversion_factor' => null, 'created_at' => now(), 'updated_at' => now(), 'no_of_decimal_places' => 2],
            ['name' => 'Kilogram', 'code' => 'kg', 'unit_type' => 'simple', 'quantity_type' => 'weight', 'description' => 'SI base unit of mass', 'status' => 'active', 'icon' => 'FaWeight', 'uqc_id' => null, 'primary_stock_unit_id' => null, 'secondary_stock_unit_id' => null, 'conversion_factor' => null, 'created_at' => now(), 'updated_at' => now(), 'no_of_decimal_places' => 2],
            ['name' => 'Gram', 'code' => 'g', 'unit_type' => 'simple', 'quantity_type' => 'weight', 'description' => '0.001 kilograms', 'status' => 'active', 'icon' => 'FaWeight', 'uqc_id' => null, 'primary_stock_unit_id' => null, 'secondary_stock_unit_id' => null, 'conversion_factor' => null, 'created_at' => now(), 'updated_at' => now(), 'no_of_decimal_places' => 2],
            ['name' => 'Liter', 'code' => 'L', 'unit_type' => 'simple', 'quantity_type' => 'volume', 'description' => 'Unit of volume', 'status' => 'active', 'icon' => 'FaTint', 'uqc_id' => null, 'primary_stock_unit_id' => null, 'secondary_stock_unit_id' => null, 'conversion_factor' => null, 'created_at' => now(), 'updated_at' => now(), 'no_of_decimal_places' => 2],
            ['name' => 'Milliliter', 'code' => 'mL', 'unit_type' => 'simple', 'quantity_type' => 'volume', 'description' => '0.001 liters', 'status' => 'active', 'icon' => 'FaTint', 'uqc_id' => null, 'primary_stock_unit_id' => null, 'secondary_stock_unit_id' => null, 'conversion_factor' => null, 'created_at' => now(), 'updated_at' => now(), 'no_of_decimal_places' => 2],
            ['name' => 'Second', 'code' => 's', 'unit_type' => 'simple', 'quantity_type' => 'others', 'description' => 'Unit of time', 'status' => 'active', 'icon' => 'FaClock', 'uqc_id' => null, 'primary_stock_unit_id' => null, 'secondary_stock_unit_id' => null, 'conversion_factor' => null, 'created_at' => now(), 'updated_at' => now(), 'no_of_decimal_places' => 2],
            // Compound unit example
            [
                'name' => 'Dozen',
                'code' => 'doz',
                'unit_type' => 'compound',
                'quantity_type' => 'measure',
                'description' => '12 pieces',
                'status' => 'active',
                'icon' => 'FaBoxes',
                'uqc_id' => null,
                'primary_stock_unit_id' => 11, // assuming 'Pieces' is id 11
                'secondary_stock_unit_id' => null,
                'conversion_factor' => 12.0,
                'created_at' => now(),
                'updated_at' => now(),
                'no_of_decimal_places' => 2
            ],
            ['name' => 'Pieces', 'code' => 'pc', 'unit_type' => 'simple', 'quantity_type' => 'measure', 'description' => 'Individual pieces', 'status' => 'active', 'icon' => 'FaCube', 'uqc_id' => null, 'primary_stock_unit_id' => null, 'secondary_stock_unit_id' => null, 'conversion_factor' => null, 'created_at' => now(), 'updated_at' => now(), 'no_of_decimal_places' => 2],
        ]);
    }
}
