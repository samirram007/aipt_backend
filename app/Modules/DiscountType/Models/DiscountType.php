<?php

namespace App\Modules\DiscountType\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountType extends Model
{
    use HasFactory;

    protected $table = 'discount_types';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'value',
        'icon'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
