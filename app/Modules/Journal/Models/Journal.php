<?php

namespace App\Modules\Journal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model
{
    use HasFactory;

    protected $table = 'journals';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
 'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
