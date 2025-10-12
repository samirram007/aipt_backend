<?php

namespace App\Modules\Patient\Models;

use App\Modules\AccountLedger\Models\AccountLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Address\Models\Address;
use App\Modules\Agent\Models\Agent;
use App\Modules\Physician\Models\Physician;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Patient extends Model
{
    use HasFactory;

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

    public function physician(){
        return $this->belongsTo(Physician::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

}
