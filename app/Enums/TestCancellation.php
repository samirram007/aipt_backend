<?php

namespace App\Enums;

enum TestCancellation: string
{
    case Approved = 'approved';
    case Discard = 'discard';
    case Request = 'request';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
