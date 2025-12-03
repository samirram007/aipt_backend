<?php

namespace App\Modules\DiscountType\Models;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiscountType extends Model
{
    use HasFactory, Blamable;

    protected $table = 'discount_types';

    protected $fillable = [
        'name',
        'code',
        'is_percentage',
        'value',
        'account_ledger_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_percentage' => 'boolean'
    ];

    public function account_ledger(): BelongsTo
    {
        return $this->belongsTo(AccountLedger::class, 'account_ledger_id', 'id');
    }
}
