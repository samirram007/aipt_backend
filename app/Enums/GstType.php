<?php
namespace App\Enums;

enum GstType: string
{
    case CgstSgst = 'cgst_sgst';
    case Igst = 'igst';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

}
