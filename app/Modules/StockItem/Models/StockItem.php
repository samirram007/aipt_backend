<?php

namespace App\Modules\StockItem\Models;

use App\Enums\CostingMethod;
use App\Enums\MarketValuationMethod;
use App\Enums\TypeOfSupply;
use App\Modules\StockCategory\Models\StockCategory;
use App\Modules\StockGroup\Models\StockGroup;
use App\Modules\StockItemPrice\Models\StockItemPrice;
use App\Modules\StockUnit\Models\StockUnit;
use App\Modules\UniqueQuantityCode\Models\UniqueQuantityCode;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockItem extends Model
{
    use HasFactory, Blamable;

    protected $table = 'stock_items';

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
        'alternate_stock_unit_id',
        'base_unit_value',
        'alternate_unit_value',
        'unique_quantity_code_id',
        'type_of_supply',
        'is_negative_sales_allow',
        'is_maintain_batch',
        'is_maintain_serial',
        'use_expiry_date',
        'track_manufacturing_date',
        'is_finish_goods',
        'is_raw_material',
        'is_unfinished_goods',
        'costing_method',
        'market_valuation_method',
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
        'stock_item_brand_id',
        'mrp',
        'standard_cost',
        'standard_selling_price',
        'icon',
        'status',
        'is_package',
        'is_sample_required',
        'sample_name',
        'process_duration',
        'process_type',
        'created_by',
        'updated_by'
    ];

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


    public function stock_item_prices(): HasMany
    {
        return $this->hasMany(StockItemPrice::class, 'stock_price_id', 'id');
    }
    public function stock_category(): BelongsTo
    {
        return $this->belongsTo(StockCategory::class, 'stock_category_id', 'id');
    }
    public function stock_group(): BelongsTo
    {
        return $this->belongsTo(StockGroup::class, 'stock_group_id', 'id');
    }
    public function stock_unit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class, 'stock_unit_id', 'id');
    }
    public function alternate_stock_unit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class, 'alternate_stock_unit_id', 'id');
    }
    public function unique_quantity_code(): BelongsTo
    {
        return $this->belongsTo(UniqueQuantityCode::class, 'unique_quantity_id', 'id');
    }
}
