<?php

namespace App\Modules\Physician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Discipline\Models\Discipline;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Physician extends Model
{
    use HasFactory;

    protected $table = 'physicians';

    protected $fillable = [
        'name',
        'degree',
        'email',
        'contact_no',
        'discipline_id',
        'is_active'
    ];

    protected $casts = [
 'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function account_ledger(): BelongsTo{
        return $this->belongsTo(AccountLedger::class);
    }
    public function discipline(): BelongsTo{
        return $this->belongsTo(Discipline::class);
    }
}
