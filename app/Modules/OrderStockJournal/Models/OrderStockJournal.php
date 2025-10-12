<?php

namespace App\Modules\OrderStockJournal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStockJournal extends Model
{
    use HasFactory;

    protected $table = 'order_stock_journals';

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
