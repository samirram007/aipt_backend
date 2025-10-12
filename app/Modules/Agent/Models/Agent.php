<?php

namespace App\Modules\Agent\Models;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Address\Models\Address;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Agent extends Model
{
    use HasFactory;

    protected $table = 'agents';

    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'commission_percent',
        'is_active'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function account_ledger(): MorphOne
    {
        return $this->morphOne(AccountLedger::class, 'ledgerable');
    }
}
