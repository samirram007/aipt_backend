<?php
namespace App\Enums;

enum SymbolPosition: string
{
    case Before = 'before';
    case After = 'after';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }


}
