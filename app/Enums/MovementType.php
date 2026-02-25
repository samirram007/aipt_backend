<?php
namespace App\Enums;

enum MovementType: string
{
    case IN = 'in';
    case OUT = 'out';


    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

}
