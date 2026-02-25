<?php
namespace App\Enums;

enum AccountingEffect: string
{
    case Debit = 'debit';
    case Credit = 'credit';


    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

}
