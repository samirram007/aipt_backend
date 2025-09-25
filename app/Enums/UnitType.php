<?php
namespace App\Enums;

enum UnitType: string
{
    case Simple = 'simple';
    case Compound = 'compound';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

}
