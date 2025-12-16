<?php

namespace App\Modules\TestCancellationRequest\Models;

use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestCancellationRequest extends Model
{
    use HasFactory;

    protected $table = 'test_cancellation_requests';

    protected $fillable = [
        'stock_journal_entry_id',
        'status',
        'remarks',
        'requested_by',
        'cancelled_by',
        'approved_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function stock_journal_entry(): BelongsTo
    {
        return $this->belongsTo(StockJournalEntry::class, 'stock_journal_entry_id', 'id');
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }
}
