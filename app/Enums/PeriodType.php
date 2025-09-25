<?php
namespace App\Enums;

enum PeriodType: string
{
    case Monthly = 'monthly';
    case Quarterly = 'quarterly';
    case HalfYearly = 'half_yearly';
    case Yearly = 'yearly';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }


}
