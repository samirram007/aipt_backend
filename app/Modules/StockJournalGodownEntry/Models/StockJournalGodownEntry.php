<?php

namespace App\Modules\StockJournalGodownEntry\Models;

use App\Enums\MovementType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockJournalGodownEntry extends Model
{
    use HasFactory;

    protected $table = 'stock_journal_godown_entries';

    protected $fillable = [
        'stock_journal_entry_id',
        'godown_id',
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

    public function stock_journal_entry(): BelongsTo
    {
        return $this->belongsTo(\App\Modules\StockJournalEntry\Models\StockJournalEntry::class, 'stock_journal_entry_id');
    }

    public function godown(): BelongsTo
    {
        return $this->belongsTo(\App\Modules\Godown\Models\Godown::class, 'godown_id');
    }
    public function stock_item(): mixed
    {
        return $this->stock_journal_entry->stock_item();
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


}
