<?php
namespace App\Enums;

//['fifo','lifo','moving_average','standard','batch','serial']
enum CostingMethod: string
{
    case AtZeroCost = 'at_zero_cost';
    case AvgCost = 'avg_cost';
    case FIFO = 'fifo';
    case FIFOPerpetual = 'fifo_perpetual';
    case LastPurchaseCost = 'last_purchase_cost';
    case LIFOAnnual = 'lifo_annual';
    case LIFOPerpetual = 'lifo_perpetual';
    case MOnthlyAverageCost = 'monthly_average_cost';

    case StdCost = 'std_cost';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
