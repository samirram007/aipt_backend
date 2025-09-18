<?php

namespace App\Modules\StockGroup\Models;

use App\Enums\ActiveInactive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockGroup extends Model
{
    use HasFactory;

    protected $table = 'stock_groups';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'parent_id',
        'should_quantities_of_items_be_added'

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => ActiveInactive::class,
        'should_quantities_of_items_be_added' => 'boolean'
    ];

    function parent(): BelongsTo
    {
        return $this->belongsTo(StockGroup::class);
    }

    function child(): HasMany
    {
        return $this->hasMany(StockGroup::class, 'parent_stock_category_id', 'id');
    }
}
