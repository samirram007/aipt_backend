<?php

namespace App\Modules\StockJournalEntry\Models;

use App\Modules\JobOrder\Models\JobOrder;
use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockUnit\Models\StockUnit;
use App\Modules\TestItem\Models\TestItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'start_date',
        'end_date'

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function stock_journal():BelongsTo{
        return $this->belongsTo(StockJournal::class,'stock_journal_id','id');
    }

    public function stock_item():BelongsTo{
        return $this->belongsTo(StockItem::class,'stock_item_id','id');
    }

    public function stock_unit():BelongsTo{
        return $this->belongsTo(StockUnit::class,'stock_unit_id','id');
    }

    public function job_order():HasOne{
        return $this->hasOne(JobOrder::class,'stock_journal_entry_id','id');
    }
}
