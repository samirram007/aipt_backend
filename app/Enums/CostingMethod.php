<?php
namespace App\Enums;

//['fifo','lifo','moving_average','standard','batch','serial']
enum CostingMethod: string
{
    case FIFO = 'fifo';
    case LIFO = 'lifo';
    case MovingAverage = 'moving_average';
    case Batch = 'batch';
    case Serial = 'serial';

    case Average = 'average';
    case Standard = 'standard';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
