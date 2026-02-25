<?php

namespace App\Enums;

enum AccountingNature: string
{
    case Assets = 'Assets';
    case Equity = 'Equity';
    case Expenses = 'Expenses';
    case Income = 'Income';
    case Liabilities = 'Liabilities';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

}
