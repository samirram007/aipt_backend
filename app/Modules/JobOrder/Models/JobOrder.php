<?php

namespace App\Modules\JobOrder\Models;

use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\TestBooking\Models\TestBooking;
use App\Modules\TestItem\Models\TestItem;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobOrder extends Model
{
    use HasFactory;

    protected $table = 'job_orders';

    protected $fillable = [
        "voucher_id",
        "stock_journal_id",
        "stock_journal_entry_id",
        "expected_start_date",
        "expected_end_date",
        "actual_start_date",
        "actual_end_date",
        "status",
        "stock_item_id",
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function stock_item(): BelongsTo
    {
        return $this->belongsTo(StockItem::class, 'stock_item_id','id');
    }
    public function test_item(): BelongsTo
    {
        return $this->belongsTo(TestItem::class, 'stock_item_id','id');
    }

    public function stock_journal_entry(): BelongsTo
    {
        return $this->belongsTo(StockJournalEntry::class, 'stock_journal_entry_id','id');
    }

    public function test_booking():BelongsTo
    {
        return $this->belongsTo(TestBooking::class, 'voucher_id', 'id');
    }

}
