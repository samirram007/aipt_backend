<?php

namespace App\Modules\BusinessReport\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessReport extends Model
{
    use HasFactory;

    protected $table = 'business_reports';

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
