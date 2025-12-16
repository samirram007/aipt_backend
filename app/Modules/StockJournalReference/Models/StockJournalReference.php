<?php

namespace App\Modules\StockJournalReference\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockJournalReference extends Model
{
    use HasFactory, Blamable;

    protected $table = 'stock_journal_references';

    protected $fillable = [
        'stock_journal_id',
        'stock_journal_reference_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
