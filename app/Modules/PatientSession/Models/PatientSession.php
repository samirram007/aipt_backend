<?php

namespace App\Modules\PatientSession\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Modules\Patient\Models\Patient;
use App\Modules\Doctor\Models\Doctor;

class PatientSession extends Model
{
    use HasFactory;

    protected $table = 'patient_sessions';



    protected $fillable = [
        'patient_id',
        'doctor_id',
        'session_type',
        'session_start_time',
        'session_close_time',
        'status'

    ];

    protected $casts = [
        'session_start_time' => 'datetime',
        'session_close_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
