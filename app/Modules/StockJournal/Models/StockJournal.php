<?php

namespace App\Modules\StockJournal\Models;

use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\Voucher\Models\Voucher;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockJournal extends Model
{
    use HasFactory, Blamable;

    protected $table = 'stock_journals';

    protected $fillable = [
        'journal_no',
        'journal_date',
        'voucher_id',
        'type',
        'remarks',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function stock_journal_entries(): HasMany
    {
        return $this->hasMany(StockJournalEntry::class);
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }
}
