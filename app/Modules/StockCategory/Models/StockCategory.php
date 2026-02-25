<?php

namespace App\Modules\StockCategory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockCategory extends Model
{
    use HasFactory;

    protected $table = 'stock_categories';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'parent_id'

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    function parent(): BelongsTo
    {
        return $this->belongsTo(StockCategory::class);
    }

    function child(): HasMany
    {
        return $this->hasMany(StockCategory::class, 'parent_stock_category_id', 'id');
    }

}
