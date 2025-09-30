<?php

namespace App\Modules\StockJournalEntry\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockJournalEntry extends Model
{
    use HasFactory;

    protected $table = 'stock_journal_entries';

    protected $fillable = [
        'stock_journal_id',
        'stock_item_id',
        'stock_unit_id',
        'alternate_unit_id',
        'unit_ratio',
        'item_cost',
        'quantity',
        'rate',
        'movement_type',
        'godown_id',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
