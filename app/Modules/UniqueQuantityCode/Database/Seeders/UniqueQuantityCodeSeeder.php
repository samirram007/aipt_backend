<?php

namespace App\Modules\UniqueQuantityCode\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\UniqueQuantityCode\Models\UniqueQuantityCode;

class UniqueQuantityCodeSeeder extends Seeder
{
    public function run(): void
    {
        $uqcs = [
            ['id' => 1, 'name' => 'BAGS', 'code' => 'BAG', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaBoxOpen', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'BALE', 'code' => 'BAL', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaBoxes', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'BUNDLES', 'code' => 'BDL', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaBoxes', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'BUCKLES', 'code' => 'BKL', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaLink', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'BILLIONS OF UNITS', 'code' => 'BOU', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaInfinity', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'BOX', 'code' => 'BOX', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaBox', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'BOTTLES', 'code' => 'BTL', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaWineBottle', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'BUNCHES', 'code' => 'BUN', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaSeedling', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'name' => 'CANS', 'code' => 'CAN', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaRecycle', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'name' => 'CUBIC METER', 'code' => 'CBM', 'quantity_type' => 'volume', 'description' => null, 'status' => 'active', 'icon' => 'FaCube', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'name' => 'CUBIC CENTIMETER', 'code' => 'CCM', 'quantity_type' => 'volume', 'description' => null, 'status' => 'active', 'icon' => 'FaCube', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'name' => 'CENTIMETER', 'code' => 'CMS', 'quantity_type' => 'length', 'description' => null, 'status' => 'active', 'icon' => 'FaRuler', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'name' => 'CARTONS', 'code' => 'CTN', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaBoxes', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'name' => 'DOZEN', 'code' => 'DOZ', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaBox', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'name' => 'DRUM', 'code' => 'DRM', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaDrum', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'name' => 'GREAT GROSS', 'code' => 'GGR', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaCube', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'name' => 'GRAMS', 'code' => 'GMS', 'quantity_type' => 'weight', 'description' => null, 'status' => 'active', 'icon' => 'FaWeight', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'name' => 'GROSS', 'code' => 'GRS', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaCube', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'name' => 'GROSS YARDS', 'code' => 'GYD', 'quantity_type' => 'length', 'description' => null, 'status' => 'active', 'icon' => 'FaRuler', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'name' => 'KILOGRAMS', 'code' => 'KGS', 'quantity_type' => 'weight', 'description' => null, 'status' => 'active', 'icon' => 'FaWeightHanging', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'name' => 'KILOLITER', 'code' => 'KLR', 'quantity_type' => 'volume', 'description' => null, 'status' => 'active', 'icon' => 'FaTint', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'name' => 'KILOMETRE', 'code' => 'KME', 'quantity_type' => 'length', 'description' => null, 'status' => 'active', 'icon' => 'FaRuler', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'name' => 'MILLILITRE', 'code' => 'MLT', 'quantity_type' => 'volume', 'description' => null, 'status' => 'active', 'icon' => 'FaTint', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 24, 'name' => 'METERS', 'code' => 'MTR', 'quantity_type' => 'length', 'description' => null, 'status' => 'active', 'icon' => 'FaRuler', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 25, 'name' => 'METRIC TONS', 'code' => 'MTS', 'quantity_type' => 'weight', 'description' => null, 'status' => 'active', 'icon' => 'FaWeightHanging', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 26, 'name' => 'NUMBERS', 'code' => 'NOS', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaHashtag', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 27, 'name' => 'PACKS', 'code' => 'PAC', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaBoxes', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 28, 'name' => 'PIECES', 'code' => 'PCS', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaCube', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 29, 'name' => 'PAIRS', 'code' => 'PRS', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaLink', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 30, 'name' => 'QUINTAL', 'code' => 'QTL', 'quantity_type' => 'weight', 'description' => null, 'status' => 'active', 'icon' => 'FaWeight', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 31, 'name' => 'ROLLS', 'code' => 'ROL', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaBoxes', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 32, 'name' => 'SETS', 'code' => 'SET', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaThLarge', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 33, 'name' => 'SQUARE FEET', 'code' => 'SQF', 'quantity_type' => 'area', 'description' => null, 'status' => 'active', 'icon' => 'FaShapes', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 34, 'name' => 'SQUARE METERS', 'code' => 'SQM', 'quantity_type' => 'area', 'description' => null, 'status' => 'active', 'icon' => 'FaShapes', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 35, 'name' => 'SQUARE YARDS', 'code' => 'SQY', 'quantity_type' => 'area', 'description' => null, 'status' => 'active', 'icon' => 'FaShapes', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 36, 'name' => 'TABLETS', 'code' => 'TBS', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaTabletAlt', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 37, 'name' => 'TEN GROSS', 'code' => 'TGM', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaBox', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 38, 'name' => 'THOUSANDS', 'code' => 'THD', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaHashtag', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 39, 'name' => 'TONNES', 'code' => 'TON', 'quantity_type' => 'weight', 'description' => null, 'status' => 'active', 'icon' => 'FaWeightHanging', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 40, 'name' => 'TUBES', 'code' => 'TUB', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaCircle', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 41, 'name' => 'US GALLONS', 'code' => 'UGS', 'quantity_type' => 'volume', 'description' => null, 'status' => 'active', 'icon' => 'FaTint', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 42, 'name' => 'UNITS', 'code' => 'UNT', 'quantity_type' => 'measure', 'description' => null, 'status' => 'active', 'icon' => 'FaHashtag', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 43, 'name' => 'YARDS', 'code' => 'YDS', 'quantity_type' => 'length', 'description' => null, 'status' => 'active', 'icon' => 'FaRuler', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 44, 'name' => 'OTHERS', 'code' => 'OTH', 'quantity_type' => 'others', 'description' => null, 'status' => 'active', 'icon' => 'FaEllipsisH', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($uqcs as $uqc) {
            UniqueQuantityCode::updateOrCreate(
                ['id' => $uqc['id']],
                $uqc
            );
        }
    }
}
