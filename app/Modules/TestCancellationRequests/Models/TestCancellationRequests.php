<?php

namespace App\Modules\TestCancellationRequests\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestCancellationRequests extends Model
{
    use HasFactory;

    protected $table = 'test_cancellation_requests';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'cancelled_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
