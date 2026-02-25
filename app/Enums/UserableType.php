<?php
namespace App\Enums;

enum UserableType: string
{
    case Admin = 'admin';
    case Employee = 'employee';
    case Customer = 'customer';
    case Supplier = 'supplier';
    case Vendor = 'vendor';
    case Client = 'client';
    case Contractor = 'contractor';
    case Partner = 'partner';
    case Agent = 'agent';

    case Other = 'other';
    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
