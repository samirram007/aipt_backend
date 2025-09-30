<?php

namespace App\Modules\StockJournal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockJournal extends Model
{
    use HasFactory;

    protected $table = 'stock_journals';

    protected $fillable = [
        'journal_no',
        'journal_date',
        'voucher_id',
        'type',
        'remarks',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
