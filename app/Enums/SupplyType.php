<?php
namespace App\Enums;

enum SupplyType: string
{
    case CapitalGoods = 'capital_goods';
    case Goods = 'goods';
    case Services = 'services';
}
