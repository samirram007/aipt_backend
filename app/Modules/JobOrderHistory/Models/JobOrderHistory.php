<?php

namespace App\Modules\JobOrderHistory\Models;

use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOrderHistory extends Model
{
    use HasFactory, Blamable;

    protected $table = 'job_order_histories';

    protected $fillable = [
        'job_order_id',
        'status',
        'changed_at',
        'process_by',
        'remarks',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
