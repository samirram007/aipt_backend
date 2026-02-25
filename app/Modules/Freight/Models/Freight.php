<?php

namespace App\Modules\Freight\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Freight extends Model
{
    use HasFactory;

    protected $table = 'freights';

    protected $fillable = [

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
