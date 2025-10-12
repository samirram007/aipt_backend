<?php

namespace App\Modules\AppMaintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppMaintenance extends Model
{
    use HasFactory;

    protected $table = 'app_maintenances';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
 'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
