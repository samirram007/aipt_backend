<?php

namespace App\Modules\CapitalItemMaintenanceLog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CapitalItemMaintenanceLog extends Model
{
    use HasFactory;

    protected $table = 'capital_item_maintenance_logs';

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
