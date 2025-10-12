<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case Pending = 'pending';
    case Partial = 'partial';
    case Completed = 'completed';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
