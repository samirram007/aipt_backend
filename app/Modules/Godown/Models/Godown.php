<?php

namespace App\Modules\Godown\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Godown extends Model
{
    use HasFactory;

    protected $table = 'godowns';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'parent_id',
        'address',
        'our_stock_with_third_party',
        'third_party_stock_with_us'

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'our_stock_with_third_party' => 'boolean',
        'third_party_stock_with_us' => 'boolean',
        'address' => 'array'
    ];
    function parent(): BelongsTo
    {
        return $this->belongsTo(Godown::class);
    }
}
