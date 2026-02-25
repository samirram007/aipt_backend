<?php

namespace App\Modules\UniqueQuantityCode\Models;

use App\Enums\QuantityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UniqueQuantityCode extends Model
{
    use HasFactory;

    protected $table = 'unique_quantity_codes';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'icon',
        'quantity_type'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'quantity_type' => QuantityType::class
    ];
}
