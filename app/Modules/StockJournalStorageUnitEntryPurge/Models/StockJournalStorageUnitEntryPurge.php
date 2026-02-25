<?php

namespace App\Modules\StockJournalStorageUnitEntryPurge\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockJournalStorageUnitEntryPurge extends Model
{
    use HasFactory;

    protected $table = 'stock_journal_storage_unit_entry_purges';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
