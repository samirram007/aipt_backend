<?php

namespace App\Modules\StockItem\Models;

use App\Enums\CostingMethod;
use App\Enums\TypeOfSupply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemPrice extends Model
{
    use HasFactory;

    protected $table = 'item_prices';

    protected $fillable = [
        'name',
        'code',
        'print_name',
        'sku',
        'article_no',
        'part_no',
        'description',
        'stock_category_id',
        'stock_group_id',
        'stock_unit_id',
        'alternative_stock_unit_id',
        'alternate_unit_ratio',
        'invoice_stock_unit_id',
        'invoice_conversion_factor',
        'no_of_decimal_places',
        'unique_quantity_code_id',
        'type_of_supply',
        'is_negative_sales_allow',
        'is_maintain_batch',
        'is_maintain_serial',
        'is_expiry_item',
        'is_finish_goods',
        'is_raw_material',
        'is_unfinished_goods',
        'costing_method',
        'pricing_method',
        'reorder_level',
        'minimum_stock',
        'maximum_stock',
        'has_bom',
        'is_sales_as_new_manufacture',
        'is_purchase_as_consumed',
        'is_rejection_as_scrap',
        'is_gst_applicable',
        'rate_of_duty',
        'hsn_sac_code',
        'is_gst_inclusive',
        'gst_type',
        'brand_id',
        'mrp',
        'standard_cost',
        'icon',
        'status',


    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_negative_sales_allow' => 'boolean',
        'is_maintain_batch' => 'boolean',
        'is_maintain_serial' => 'boolean',
        'is_expiry_item' => 'boolean',
        'is_finish_goods' => 'boolean',
        'is_raw_material' => 'boolean',
        'is_unfinished_goods' => 'boolean',
        'type_of_supply' => TypeOfSupply::class,
        'costing_method' => CostingMethod::class,
        'pricing_method' => CostingMethod::class,
        'has_bom' => 'boolean',
        'is_gst_applicable' => 'boolean',
        'is_gst_inclusive' => 'boolean',
        'is_sales_as_new_manufacture' => 'boolean',
        'is_purchase_as_consumed' => 'boolean',
        'is_rejection_as_scrap' => 'boolean',


    ];
}
