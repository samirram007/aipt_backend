<?php
namespace App\Enums;

//['mrp','list','cost_plus','discount','contract','dynamic']
enum MarketValuationMethod: string
{
    case AtZeroPrice = 'at_zero_price';
    case AvgPrice = 'avg_price';
    case LastSalePrice = 'last_sale_price';
    case StandardPrice = 'std_price';
    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
