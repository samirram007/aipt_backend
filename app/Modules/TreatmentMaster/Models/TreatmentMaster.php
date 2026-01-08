<?php

namespace App\Modules\TreatmentMaster\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreatmentMaster extends Model
{
    use HasFactory;

    protected $table = 'treatment_masters';

    protected $fillable = [
        'name',
        'default_cost',
        'code',
        'description',
        'status',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}