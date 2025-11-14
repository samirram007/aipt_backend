<?php

namespace App\Modules\StockJournalEntry\Models;

use App\Enums\MovementType;
use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockJournalGodownEntry\Models\StockJournalGodownEntry;
use App\Modules\StockUnit\Models\StockUnit;
use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockJournalEntry extends Model
{
    use HasFactory;
    use Blameable;

    protected $table = 'stock_journal_entries';

    protected $fillable = [
        'stock_journal_id',
        'stock_item_id',
        'stock_unit_id',
        'alternate_unit_id',
        'unit_ratio',
        'item_cost',
        'actual_quantity',
        'billing_quantity',
        'rate',
        'rate_unit_id',
        'discount_percentage',
        'discount',
        'amount',
        'movement_type',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'movement_type' => MovementType::class,
    ];
    public function stock_journal(): BelongsTo
    {
        return $this->belongsTo(StockJournal::class, 'stock_journal_id');
    }
    public function stock_journal_godown_entries(): HasMany
    {
        return $this->hasMany(StockJournalGodownEntry::class, 'stock_journal_entry_id');
    }
    public function stock_item(): BelongsTo
    {
        return $this->belongsTo(StockItem::class, 'stock_item_id');
    }
    public function stock_unit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class, 'stock_unit_id');
    }
    public function alternate_unit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class, 'alternate_unit_id');
    }
    public function rate_unit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class, 'rate_unit_id');
    }


}
