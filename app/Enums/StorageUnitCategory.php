<?php

namespace App\Enums;

enum StorageUnitCategory: string
{
    case PHYSICAL = 'PHYSICAL';
    case MOBILE = 'MOBILE';
    case VIRTUAL = 'VIRTUAL';
    case PROCESS = 'PROCESS';

    public function label(): string
    {
        return match ($this) {
            self::PHYSICAL => 'Physical',
            self::MOBILE => 'Mobile',
            self::VIRTUAL => 'Virtual',
            self::PROCESS => 'Process',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
