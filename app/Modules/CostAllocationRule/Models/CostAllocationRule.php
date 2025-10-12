<?php

namespace App\Modules\CostAllocationRule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CostAllocationRule extends Model
{
    use HasFactory;

    protected $table = 'cost_allocation_rules';

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
