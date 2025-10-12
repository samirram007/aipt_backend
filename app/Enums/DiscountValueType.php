<?php

namespace App\Enums;

enum DiscountValueType: string
{
    case Percentage = 'percentage';
    case Fixed = 'fixed';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
