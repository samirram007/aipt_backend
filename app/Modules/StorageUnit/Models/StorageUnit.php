<?php

namespace App\Modules\StorageUnit\Models;

use App\Modules\Address\Models\Address;
use App\Modules\StockUnit\Models\StockUnit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StorageUnit extends Model
{
    use HasFactory;

    protected $table = 'storage_units';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'icon',
        'storage_unit_type',
        'storage_unit_category',
        'parent_id',
        'is_virtual',
        'is_mobile',
        'our_stock_with_third_party',
        'third_party_stock_with_us',
        'capacity_value',
        'capacity_unit_id',
        'temperature_min',
        'temperature_max',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_virtual' => 'boolean',
        'is_mobile' => 'boolean',
        'our_stock_with_third_party' => 'boolean',
        'third_party_stock_with_us' => 'boolean',
        'capacity_value' => 'decimal:12,3',
        'capacity_unit_id' => 'integer',
        'temperature_min' => 'decimal:5,2',
        'temperature_max' => 'decimal:5,2',
        'parent_id' => 'integer',
        'storage_unit_type' => 'string',
        'storage_unit_category' => 'string',
        'status' => 'string',
        'code' => 'string',
        'description' => 'string',

    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(StorageUnit::class, 'parent_id', 'id');
    }
    public function capacity_unit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class, 'capacity_unit_id', 'id');
    }
    public static function getUniqueCode(): string
    {
        $prefix = 'LOC';
        $padding = 6; // total digits

        // Get the last code (sorted by numeric part)
        $lastCode = self::where('code', 'LIKE', "{$prefix}-%")
            ->orderBy('code', 'desc')
            ->value('code');

        if ($lastCode) {
            // Extract numeric part
            $lastNumber = (int) str_replace($prefix . '-', '', $lastCode);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Pad with leading zeros (EMP-000001)
        $newCode = sprintf("%s-%0{$padding}d", $prefix, $nextNumber);

        return $newCode;
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
