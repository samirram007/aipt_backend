<?php

namespace App\Enums;

enum StorageUnitType: string
{
    /* =========================
     * CORE / STRUCTURAL
     * ========================= */
    case FACILITY = 'FACILITY';
    case WAREHOUSE = 'WAREHOUSE';
    case GODOWN = 'GODOWN';
    case BUILDING = 'BUILDING';
    case FLOOR = 'FLOOR';
    case ZONE = 'ZONE';
    case STORAGE_ROOM = 'STORAGE_ROOM';
    case AISLE = 'AISLE';

    /* =========================
     * STORAGE STRUCTURES
     * ========================= */
    case RACK = 'RACK';
    case SHELF = 'SHELF';
    case BIN = 'BIN';
    case LOCATION = 'LOCATION';

    /* =========================
     * OPEN / OUTDOOR
     * ========================= */
    case YARD = 'YARD';
    case COURT = 'COURT';
    case MEZZANINE = 'MEZZANINE';

    /* =========================
     * MOBILE / TRANSPORT
     * ========================= */
    case CONTAINER = 'CONTAINER';
    case TRUCK = 'TRUCK';
    case TRAILER = 'TRAILER';
    case VAN = 'VAN';
    case TANKER = 'TANKER';
    case SILO = 'SILO';

    /* =========================
     * LOGICAL / VIRTUAL
     * ========================= */
    case VIRTUAL = 'VIRTUAL';
    case IN_TRANSIT = 'IN_TRANSIT';
    case QUARANTINE = 'QUARANTINE';
    case DAMAGED = 'DAMAGED';
    case REJECTED = 'REJECTED';
    case RESERVED = 'RESERVED';
    case RETURN = 'RETURN';
    case HOLD = 'HOLD';

    /* =========================
     * PROCESS / PRODUCTION
     * ========================= */
    case RAW_MATERIAL = 'RAW_MATERIAL';
    case WORK_IN_PROGRESS = 'WORK_IN_PROGRESS';
    case FINISHED_GOODS = 'FINISHED_GOODS';
    case LINE_SIDE = 'LINE_SIDE';
    case BUFFER = 'BUFFER';
    case STAGING = 'STAGING';
    case DISPATCH = 'DISPATCH';

    /* =========================
     * SPECIALIZED
     * ========================= */
    case COLD_ROOM = 'COLD_ROOM';
    case HAZMAT = 'HAZMAT';
    case SAFE = 'SAFE';
    case VAULT = 'VAULT';
    case CONTROLLED_ZONE = 'CONTROLLED_ZONE';

    public function label(): string
    {
        return ucwords(strtolower(str_replace('_', ' ', $this->value)));
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
