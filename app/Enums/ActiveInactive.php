<?php
namespace App\Enums;

enum ActiveInactive: string
{
    case Active = 'active';
    case Inactive = 'inactive';


    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

}
