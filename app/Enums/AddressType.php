<?php
namespace App\Enums;

enum AddressType: string
{

    case Billing = 'billing';
    case Shipping = 'shipping';
    case Office = 'office';
    case Home = 'home';
    case Warehouse = 'warehouse';
    case Other = 'other';

}
