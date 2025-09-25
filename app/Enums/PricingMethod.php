<?php
namespace App\Enums;

//['mrp','list','cost_plus','discount','contract','dynamic']
enum PricingMethod: string
{
    case MRP = 'mrp';
    case List = 'list';
    case CostPlus = 'cost_plus';
    case Discount = 'discount';
    case Contract = 'contract';
    case Dynamic = 'dynamic';
    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
