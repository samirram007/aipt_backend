<?php

namespace App\Modules\Patient\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'patient_id',
        'name',
        'email',
        'gender',
        'dob',
        'status',
        'contact_no',
        'image'

    ];

    protected $casts = [
        'dob' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->patient_id)) {
                $model->patient_id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }
}