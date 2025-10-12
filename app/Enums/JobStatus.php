<?php

namespace App\Enums;

enum JobStatus: string
{
    case Booked = 'booked';
    case SampleCollected = 'sample_collected';
    case InProcess = 'in_process';
    case Completed = 'completed';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';
    case Drafted = 'drafted';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
