<?php

namespace App\Enums;

enum BuildingTypeEnum: string
{
    case MAIN_HOSPITAL_BLOCK = 'main_hospital_block';
    case OPD_BLOCK           = 'opd_block';
    case EMERGENCY_BLOCK     = 'emergency_block';
    case ICU_BLOCK           = 'icu_block';
    case OT_BLOCK            = 'ot_block';
    case LAB_BLOCK           = 'lab_block';
    case DIAGNOSTIC_BLOCK    = 'diagnostic_block';
    case PHARMACY_BLOCK      = 'pharmacy_block';
    case ADMIN_BLOCK         = 'admin_block';
    case HOSTEL_QUARTERS     = 'hostel_quarters';
    case STAFF_QUARTERS      = 'staff_quarters';
    case PARKING_BLOCK       = 'parking_block';
    case STORAGE_WAREHOUSE   = 'storage_warehouse';
    case LAUNDRY_BLOCK       = 'laundry_block';
    case KITCHEN_CAFETERIA   = 'kitchen_cafeteria';

    public static function getValue(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
