<?php

namespace App\Modules\StockJournalGodownEntry\Models;

use App\Enums\MovementType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockJournalGodownEntry extends Model
{
    use HasFactory;

    protected $table = 'stock_journal_godown_entries';

    protected $fillable = [
        'stock_journal_entry_id',
        'godown_id',
        'quantity',
        'rate',
        'amount',
        'movement_type',
        'remarks',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'quantity' => 'decimal:4',
        'rate' => 'decimal:2',
        'amount' => 'decimal:2',
        'movement_type' => MovementType::class,


    ];
}
