<?php
namespace App\Enums;

enum PaymentMode: string
{
    case CASH = 'cash';
    case CARD = 'card';
    case CHEQUE = 'cheque';
    case DEBIT = 'debit';
    case CREDIT = 'credit';
    case UPI = 'upi';
    case OTHER = 'other';


    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

}
