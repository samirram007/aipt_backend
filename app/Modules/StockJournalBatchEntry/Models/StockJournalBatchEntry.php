<?php

namespace App\Modules\StockJournalBatchEntry\Models;

use App\Enums\MovementType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockJournalBatchEntry extends Model
{
    use HasFactory;

    protected $table = 'stock_journal_batch_entries';

    protected $fillable = [
        'stock_journal_godown_entry_id',
        'movement_type',
        'batch_no',
        'mfg_date',
        'expiry_date',
        'serial_no',
        'quantity',
        'rate',
        'amount',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'mfg_date' => 'date',
        'expiry_date' => 'date',
        'quantity' => 'decimal:4',
        'rate' => 'decimal:2',
        'amount' => 'decimal:2',
        'movement_type' => MovementType::class,
    ];
}
