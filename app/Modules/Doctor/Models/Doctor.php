<?php

namespace App\Modules\Doctor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Modules\Department\Models\Department;
use App\Modules\Address\Models\Address;
use App\Modules\Designation\Models\Designation;
use App\Modules\User\Models\User;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    //boot function with UUID generation


    protected $fillable = [
        'doctor_id',
        'name',
        'email',
        'description',
        'designation_id',
        'department_id',
        'gender',
        'dob',
        'doj',
        'status',
        'image',
        'contact_no',

    ];

    protected $casts = [
        'dob' => 'date',
        'doj' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->doctor_id)) {
                $model->doctor_id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

     public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }


    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

}
