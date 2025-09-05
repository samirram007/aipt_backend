<?php

namespace App\Enums;

enum AccountingNature: string
{
    case Assets = 'Assets';
    case Equity = 'Equity';
    case Expenses = 'Expenses';
    case Income = 'Income';
    case Liabilities = 'Liabilities';
}
