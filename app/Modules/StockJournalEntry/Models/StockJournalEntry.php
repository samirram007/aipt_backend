<?php

namespace App\Modules\StockJournalEntry\Models;

use App\Enums\MovementType;
use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockJournalEntryPurge\Models\StockJournalEntryPurge;
use App\Modules\StockJournalGodownEntry\Models\StockJournalGodownEntry;
use App\Modules\StockUnit\Models\StockUnit;
use App\Modules\Voucher\Models\Voucher;
use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StockJournalEntry extends Model
{
    use HasFactory;
    use Blameable;

    protected $table = 'stock_journal_entries';

    protected $fillable = [
        'stock_journal_id',
        'entry_order',
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
        // 'is_cancelled',

    ];
    protected $appends = [
        'is_purged',
    ];


    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'movement_type' => MovementType::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('not_purged', function (Builder $builder) {
            $builder->whereDoesntHave('stock_journal_entry_purge');
        });
        //  static::addGlobalScope('hide_purged', function (Builder $builder) {
//             $builder->where('is_purged', 0);
//         });
        static::addGlobalScope('default_order', function (Builder $builder) {
            $builder->orderBy('entry_order', 'asc');
        });
    }

    public function stock_journal_entry_purge(): HasOne
    {
        return $this->hasOne(StockJournalEntryPurge::class, 'stock_journal_entry_id', 'id');
    }

    public function getIsPurgedAttribute(): bool
    {
        return $this->stock_journal_entry_purge()->exists();
    }

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

    public function getVoucherAttribute()
    {
        return $this->voucher();
    }
    public function getIsCancelledAttribute(): bool
    {
        return true;
    }

    public function voucher()
    {
        return $this->hasOneThrough(
            Voucher::class,
            StockJournal::class,
            'id',          // Foreign key on StockJournal table referencing StockJournalEntry? (adjust as needed)
            'id',          // Foreign key on Voucher table referencing StockJournal? (adjust as needed)
            'stock_journal_id',
            'voucher_id'
        );
    }

}
