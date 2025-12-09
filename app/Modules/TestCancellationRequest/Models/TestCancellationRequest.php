<?php

namespace App\Modules\TestCancellationRequest\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestCancellationRequest extends Model
{
    use HasFactory;

    protected $table = 'test_cancellation_requests';

    protected $fillable = [
        'stock_journal_entry_id',
        'status',
        'requested_by',
        'cancelled_by',
        'approved_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
