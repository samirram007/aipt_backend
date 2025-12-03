<?php

namespace App\Modules\Patient\Models;

use App\Modules\AccountLedger\Models\AccountLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Address\Models\Address;
use App\Modules\Agent\Models\Agent;
use App\Modules\DiscountType\Models\DiscountType;
use App\Modules\Physician\Models\Physician;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Patient extends Model
{
    use HasFactory, Blamable;

    protected $table = 'patients';

    protected $fillable = [
        'name',
        'code',
        'status',
        'gender',
        'age',
        'contact_no',
        'alt_contact_no',
        'agent_id',
        'physician_id',
        'discount_type_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function account_ledger(): MorphOne
    {
        return $this->morphOne(AccountLedger::class, 'ledgerable');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable')->where('is_primary', true);
    }

    public function physician()
    {
        return $this->belongsTo(Physician::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function discount_type(): BelongsTo
    {
        return $this->belongsTo(DiscountType::class);
    }
}
