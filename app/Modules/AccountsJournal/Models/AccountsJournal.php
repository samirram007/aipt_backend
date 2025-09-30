<?php

namespace App\Modules\AccountsJournal\Models;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Voucher\Models\Voucher;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountsJournal extends VoucherEntry
{
    use HasFactory;


}
