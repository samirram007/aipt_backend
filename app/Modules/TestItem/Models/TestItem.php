<?php

namespace App\Modules\TestItem\Models;

use App\Enums\CostingMethod;
use App\Enums\MarketValuationMethod;
use App\Enums\TypeOfSupply;
use App\Modules\StockItem\Models\StockItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestItem extends StockItem
{
    use HasFactory;


    protected $casts = [
 'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_negative_sales_allow' => 'boolean',
        'is_maintain_batch' => 'boolean',
        'is_maintain_serial' => 'boolean',
        'use_expiry_date' => 'boolean',
        'track_manufacturing_date' => 'boolean',
        'is_finish_goods' => 'boolean',
        'is_raw_material' => 'boolean',
        'is_unfinished_goods' => 'boolean',
        'type_of_supply' => TypeOfSupply::class,
        'costing_method' => CostingMethod::class,
        'market_valuation_method' => MarketValuationMethod::class,
        'has_bom' => 'boolean',
        'reorder_level' => 'float',
        'minimumStock' => 'float',
        'maximumStock' => 'float',
        'is_gst_applicable' => 'boolean',
        'is_gst_inclusive' => 'boolean',
        'is_sales_as_new_manufacture' => 'boolean',
        'is_purchase_as_consumed' => 'boolean',
        'is_rejection_as_scrap' => 'boolean',
        'is_package' => 'boolean',
        'is_sample_required' => 'boolean',
    ];
}
