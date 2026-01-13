<?php

namespace App\Modules\PatientMedicalHistory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientMedicalHistory extends Model
{
    use HasFactory;

    protected $table = 'patient_medical_histories';

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
