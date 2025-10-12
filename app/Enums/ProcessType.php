<?php

namespace App\Enums;

enum ProcessType: string
{
    case InHouse = 'inhouse';
    case Outsource = 'outsource';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
