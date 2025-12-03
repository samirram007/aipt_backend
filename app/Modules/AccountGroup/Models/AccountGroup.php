<?php

namespace App\Modules\AccountGroup\Models;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\AccountNature\Models\AccountNature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountGroup extends Model
{
    use HasFactory;

    protected $table = 'account_groups';

    protected $fillable = [
        'name',
        'code',
        'account_nature_id',
        'description',
        'status',
        'icon',
        'created_by',
        'updated_by'
    ];

    public function account_nature()
    {
        return $this->belongsTo(AccountNature::class);
    }
    public function account_ledgers()
    {
        return $this->hasMany(AccountLedger::class);
    }
}
