<?php

namespace App\Modules\JobOrderHistory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOrderHistory extends Model
{
    use HasFactory;

    protected $table = 'job_order_histories';

    protected $fillable = [
        'job_order_id',
        'status',
        'changed_at',
        'process_by',
        'remarks'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
