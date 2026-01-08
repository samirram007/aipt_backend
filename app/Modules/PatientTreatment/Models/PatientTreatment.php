<?php

namespace App\Modules\PatientTreatment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientTreatment extends Model
{
    use HasFactory;

    protected $table = 'patient_treatments';

    protected $fillable = [
        'patient_id',
        'treatment_id',
        'patient_session_id',
        'treatment_master_id',
        'treatment_date',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}