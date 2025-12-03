<?php

namespace App\Modules\Distributor\Models;

use App\Modules\Address\Models\Address;
use Illuminate\Database\Eloquent\Model;
use App\Modules\AccountLedger\Models\AccountLedger;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Distributor extends Model
{
    use HasFactory, Blamable;

    protected $table = 'distributors';

    protected $fillable = [
        'name',
        'code',
        'gstin',
        'pan',
        'contact_person',
        'contact_no',
        'phone',
        'email',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function account_ledger(): MorphOne
    {
        return $this->morphOne(AccountLedger::class, 'ledgerable');
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
