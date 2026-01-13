<?php

namespace App\Modules\PatientSurgicalHistory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientSurgicalHistory extends Model
{
    use HasFactory;

    protected $table = 'patient_surgical_histories';

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
