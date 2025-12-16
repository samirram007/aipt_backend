<?php

namespace App\Modules\StockJournal\Models;

use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StockJournal extends Model
{
    use HasFactory;

    protected $table = 'stock_journals';

    protected $fillable = [
        'journal_no',
        'journal_date',
        'type',
        'remarks',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('default_order', function (Builder $builder) {
            $builder
                ->orderBy('journal_date', 'desc')
                ->orderBy('journal_no', 'asc');
        });
    }
    public function stock_journal_entries(): HasMany
    {
        return $this->hasMany(StockJournalEntry::class, 'stock_journal_id');
    }

    public function voucher(): HasOne
    {
        return $this->hasOne(Voucher::class, 'stock_journal_id', 'id');
    }
}
