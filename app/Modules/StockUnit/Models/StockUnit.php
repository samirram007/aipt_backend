<?php

namespace App\Modules\StockUnit\Models;

use App\Enums\QuantityType;
use App\Enums\UnitType;
use App\Modules\UniqueQuantityCode\Models\UniqueQuantityCode;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockUnit extends Model
{
    use HasFactory, Blamable;

    protected $table = 'stock_units';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'unit_type',
        'quantity_type',
        'icon',
        'unique_quantity_code_id',
        'primary_stock_unit_id', // assuming 'Pieces' is id 11
        'secondary_stock_unit_id',
        'conversion_factor',
        'no_of_decimal_places',
        'created_by',
        'updated_by'

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'unit_type' => UnitType::class,
        'quantity_type' => QuantityType::class,
        'conversion_factor' => 'decimal:6'
    ];
    function primary_stock_unit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class);
    }
    function secondary_stock_unit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class);
    }
    function unique_quantity_code(): BelongsTo
    {
        return $this->belongsTo(UniqueQuantityCode::class);
    }
}
