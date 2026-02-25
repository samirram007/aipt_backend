<?php

namespace App\Modules\StockJournalSerialNoEntry\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockJournalSerialNoEntry extends Model
{
    use HasFactory;

    protected $table = 'stock_journal_serial_no_entries';

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
