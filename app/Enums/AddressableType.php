<?php
namespace App\Enums;

enum AddressableType: string
{

    case Company = 'company';
    case User = 'User';
    case Vendor = 'vendor';
    case Customer = 'customer';
    case Employee = 'employee';
    case Other = 'other';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }


}
