<?php

namespace App\Modules\StockJournalStorageUnitEntry\Models;

use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\StockJournalStorageUnitEntryPurge\Models\StockJournalStorageUnitEntryPurge;
use App\Modules\StorageUnit\Models\StorageUnit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StockJournalStorageUnitEntry extends Model
{
    use HasFactory;

    protected $table = 'stock_journal_storage_unit_entries';


    protected $fillable = [
        'stock_journal_entry_id',
        'entry_order',
        'storage_unit_id',
        'batch_no',
        'mfg_date',
        'expiry_date',
        'serial_no',
        'actual_quantity',
        'billing_quantity',
        'rate',
        'discount_percentage',
        'discount',
        'amount',
        'movement_type',
        'remarks',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'mfg_date' => 'date',
        'expiry_date' => 'date',
        'actual_quantity' => 'decimal:4',
        'billing_quantity' => 'decimal:4',
        'rate' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'discount' => 'decimal:2',
        'amount' => 'decimal:2',
        'movement_type' => MovementType::class,
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'is_purged',
    ];

    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope('hide_purged', function (Builder $builder) {
        //     $builder->where('is_purged', false);
        // });
        static::addGlobalScope('not_purged', function (Builder $builder) {
            $builder->whereDoesntHave('stock_journal_storage_unit_entry_purge');
        });

        static::addGlobalScope('default_order', function (Builder $builder) {
            $builder->orderBy('entry_order', 'asc');
        });
    }

    public function getIsPurgedAttribute(): bool
    {
        return $this->stock_journal_storage_unit_entry_purge()->exists();
    }


    public function stock_journal_storage_unit_entry_purge(): ?HasOne
    {
        return $this->hasOne(StockJournalStorageUnitEntryPurge::class, 'stock_journal_storage_unit_entry_id', 'id');
    }

    public function stock_journal_entry(): BelongsTo
    {
        return $this->belongsTo(StockJournalEntry::class, 'stock_journal_entry_id');
    }

    public function storage_unit(): BelongsTo
    {
        return $this->belongsTo(StorageUnit::class, 'storage_unit_id');
    }
    public function getStockItemAttribute()
    {
        return $this->stock_journal_entry?->stock_item;
    }
    public function stock_item(): mixed
    {
        return $this->hasOneThrough(
            StockItem::class,
            StockJournalEntry::class,
            'id',               // StockJournalEntry.id
            'id',               // StockItem.id
            'stock_journal_entry_id', // StockJournalGodownEntry.stock_journal_entry_id
            'stock_item_id'           // StockJournalEntry.stock_item_id
        );
        // return $this->stock_journal_entry->stock_item();
    }

    public function stock_unit(): mixed
    {
        return $this->stock_journal_entry->stock_unit();
    }

    public function alternate_unit(): mixed
    {
        return $this->stock_journal_entry->alternate_unit();
    }
    public function rate_unit(): mixed
    {
        return $this->stock_journal_entry->rate_unit();
    }
    public function rate_unit_ratio(): mixed
    {
        return $this->stock_journal_entry->rate_unit_ratio();
    }

    public function stock_journal(): mixed
    {
        return $this->stock_journal_entry->stock_journal();
    }
    public function voucher(): mixed
    {
        return $this->stock_journal_entry->voucher();
    }
}
