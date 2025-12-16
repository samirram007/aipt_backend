<?php

namespace App\Modules\StockJournalGodownEntryPurge\Models;

use App\Modules\StockJournalGodownEntry\Models\StockJournalGodownEntry;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockJournalGodownEntryPurge extends Model
{
    use HasFactory;

    protected $table = 'stock_journal_godown_entry_purges';

    protected $fillable = [
        'stock_journal_godown_entry_id',
        'purged_by',
        'purged_at',
        'reason',

    ];
    public $timestamps = false;
    protected $casts = [
        'purged_at' => 'datetime',
    ];

    public function stock_journal_godown_entry(): BelongsTo
    {
        return $this->belongsTo(StockJournalGodownEntry::class, 'stock_journal_godown_entry_id');
    }

    public function purged_by_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'purged_by');
    }

}
