<?php

namespace App\Modules\GstRegistrationType\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GstRegistrationType extends Model
{
    use HasFactory;

    protected $table = 'gst_registration_types';

    public $timestamps = false;
    protected $fillable = [
        'name',
        'status',

    ];

    protected $casts = [
    ];
}
