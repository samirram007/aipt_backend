<?php
namespace App\Enums;

enum AddressType: string
{

    case Billing = 'billing';
    case Shipping = 'shipping';
    case Office = 'office';
    case Home = 'home';
    case Warehouse = 'warehouse';
    case Other = 'other';
    case Residence = 'residence';
    case Company = 'company';
    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }


}
