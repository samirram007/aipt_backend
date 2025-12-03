<?php

namespace App\Modules\Currency\Models;

use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory, Blamable;

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
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',

    ];
}
