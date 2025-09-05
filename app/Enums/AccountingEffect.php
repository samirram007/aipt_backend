<?php
namespace App\Enums;

enum AccountingEffect: string
{
    case Debit = 'debit';
    case Credit = 'credit';
}
