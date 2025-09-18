<?php

namespace App\Modules\StockUnit\Models;

use App\Enums\QuantityType;
use App\Enums\UnitType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockUnit extends Model
{
    use HasFactory;

    protected $table = 'stock_units';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'unit_type',
        'quantity_type',
        'icon',
        'uqc_id',
        'primary_stock_unit_id', // assuming 'Pieces' is id 11
        'secondary_stock_unit_id',
        'conversion_factor',
        'no_of_decimal_places'

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
}
