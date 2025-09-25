<?php
namespace App\Enums;

enum SupplyType: string
{
    case CapitalGoods = 'capital_goods';
    case Goods = 'goods';
    case Services = 'services';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

}
