<?php

namespace App\Modules\PatientTreatmentDetail\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientTreatmentDetail extends Model
{
    use HasFactory;

    protected $table = 'patient_treatment_details';

    protected $fillable = [
        'patient_treatment_id',
        'result',
        'remarks',
        'performed_at',
        'status',


    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
