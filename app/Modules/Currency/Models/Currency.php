<?php

namespace App\Modules\Currency\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencies';

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'country',
        'exchange_rate',
        'decimal_places',
        'status',
        'format',
        'thousands_separator',
        'decimal_separator',
        'symbol_position',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',

    ];
}
