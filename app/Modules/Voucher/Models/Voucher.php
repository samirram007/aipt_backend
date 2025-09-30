<?php

namespace App\Modules\Voucher\Models;

use App\Modules\AccountsJournal\Models\AccountsJournal;
use App\Modules\Company\Models\Company;
use App\Modules\FiscalYear\Models\FiscalYear;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use App\Modules\VoucherType\Models\VoucherType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    protected $fillable = [
        'voucher_no',
        'voucher_date',
        'voucher_type_id',
        'remarks',
        'status',
        'fiscal_year_id',
        'company_id',
        'stock_journal_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function stock_journal(): BelongsTo
    {
        return $this->belongsTo(StockJournal::class);
    }
    public function voucher_type(): BelongsTo
    {
        return $this->belongsTo(VoucherType::class);
    }
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    public function fiscal_year(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }
    public function accounts_journals(): HasMany
    {
        return $this->hasMany(AccountsJournal::class);
    }
    public function voucher_entries(): HasMany
    {
        return $this->hasMany(VoucherEntry::class);
    }


}
