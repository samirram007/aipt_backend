<?php

namespace App\Modules\AccountLedger\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\AccountGroup\Models\AccountGroup;
use App\Modules\AccountNature\Models\AccountNature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AccountLedger extends Model
{
    use HasFactory;

    protected $table = 'account_ledgers';
    protected $fillable = [
        'name',
        'code',
        'account_group_id',
        'description',
        'status',
        'icon',
        'ledgerable_id',
        'ledgerable_type'
    ];
    public static function ledgerNameExists(string $name): bool
    {
        $query = static::query()->where('name', $name);
        //dd($query->exists());

        return $query->exists();
    }
    public function account_group()
    {
        return $this->belongsTo(AccountGroup::class);
    }

    public function ledgerable(): MorphTo
    {
        return $this->morphTo();
    }
    public function account_nature(): HasOneThrough
    {
        return $this->hasOneThrough(
            AccountNature::class,     // Final related model
            AccountGroup::class,    // Intermediate model
            'id',                   // Foreign key on AccountGroup (local key on AccountLedger points to this)
            'id',                   // Foreign key on AccountType (local key on AccountGroup points to this)
            'account_group_id',     // Foreign key on AccountLedger
            'account_nature_id'       // Foreign key on AccountGroup
        );
    }
}
