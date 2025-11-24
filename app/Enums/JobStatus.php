<?php

namespace App\Enums;

enum JobStatus: string
{
    case Booked = 'booked';
    case CollectSpecimen = "collect_specimen";
    case SampleCollected = 'sample_collected';
    case InProcess = 'in_process';
    case Completed = 'completed';
    case DeliverToDesk = 'deliver_to_desk';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';
    case Drafted = 'drafted';
    case CancelRequest = "cancellation_requested";

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
