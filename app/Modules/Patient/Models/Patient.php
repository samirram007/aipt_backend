<?php

namespace App\Modules\Patient\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Address\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
        'image',
        'blood_group'

    ];

    protected $casts = [
        'dob' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }


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
