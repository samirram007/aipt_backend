<?php
namespace App\Enums;

enum QuantityType: string
{
    case Measure = 'measure';
    case Volume = 'volume';
    case Weight = 'weight';
    case Length = "length";
    case Area = "area";
    case Others = "others";


}
