<?php

namespace App\Modules\StockJournalEntry\Models;

use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockUnit\Models\StockUnit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function stock_journal():BelongsTo{
        return $this->belongsTo(StockJournal::class);
    }

    public function stock_item():BelongsTo{
        return $this->belongsTo(StockItem::class);
    }

    public function stock_unit():BelongsTo{
        return $this->belongsTo(StockUnit::class);
    }
}
