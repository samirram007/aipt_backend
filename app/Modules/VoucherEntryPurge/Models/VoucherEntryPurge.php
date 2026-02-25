<?php

namespace App\Modules\VoucherEntryPurge\Models;

use App\Modules\User\Models\User;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VoucherEntryPurge extends Model
{
    use HasFactory;

    protected $table = 'voucher_entry_purges';

    protected $fillable = [
        'voucher_entry_id',
        'purged_by',
        'purged_at',
        'reason',

    ];
    public $timestamps = false;

    protected $casts = [
        'purged_at' => 'datetime',
    ];


    public function voucher_entry()
    {
        return $this->belongsTo(VoucherEntry::class, 'voucher_entry_id');
    }

    public function purged_by_user()
    {
        return $this->belongsTo(User::class, 'purged_by');
    }

}
