<?php

namespace App\Enums;

enum CalculationType: string
{
    case currentTotal = 'current_total';
    case itemTotal = 'item_total';
    case subTotal = 'sub_total';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
