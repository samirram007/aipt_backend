<?php

namespace App\Modules\Voucher\Models;

use App\Modules\AccountsJournal\Models\AccountsJournal;
use App\Modules\Company\Models\Company;
use App\Modules\FiscalYear\Models\FiscalYear;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\VoucherDispatchDetail\Models\VoucherDispatchDetail;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use App\Modules\VoucherParty\Models\VoucherParty;
use App\Modules\VoucherReference\Models\VoucherReference;
use App\Modules\VoucherType\Models\VoucherType;
use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Voucher extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'vouchers';

    protected $fillable = [
        'voucher_no',
        'voucher_date',
        'reference_no',
        'reference_date',
        'voucher_type_id',
        'remarks',
        'status',
        'fiscal_year_id',
        'company_id',
        'stock_journal_id',
        'module',
        'is_effecting',
        'is_optional',
        'effects_account',
        'effects_stock',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'voucher_date' => 'date',
        'reference_date' => 'date',
        'is_effecting' => 'boolean',
        'is_optional' => 'boolean',
        'effects_account' => 'boolean',
        'effects_stock' => 'boolean',
    ];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('default_order', function (Builder $builder) {
            $builder
                ->orderBy('voucher_date', 'desc')
                ->orderBy('voucher_no', 'desc');
        });
    }

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
    public function voucher_party(): HasOne
    {
        return $this->hasOne(VoucherParty::class, 'voucher_id');
    }
    public function voucher_dispatch_detail(): HasOne
    {
        return $this->hasOne(VoucherDispatchDetail::class, 'voucher_id');
    }



    protected $appends = ['party_ledger', 'transaction_ledger', 'amount', 'payment_status'];


    public function voucher_references(): HasMany
    {
        return $this->hasMany(VoucherReference::class, 'voucher_id', 'id');
    }
    public function referenced_by(): HasMany
    {
        return $this->hasMany(VoucherReference::class, 'ref_voucher_id', 'id');
    }

    public function getPartyLedgerAttribute()
    {
        if (!isset($this->relations['party_ledger'])) {
            return null;
        }
        return $this->relations['party_ledger'];
    }

    public function getTransactionLedgerAttribute()
    {
        if (!isset($this->relations['transaction_ledger'])) {
            return null;
        }
        return $this->relations['transaction_ledger'];
    }

    public function getAmountAttribute()
    {
        if (!isset($this->relations['amount'])) {
            return $this->voucher_entries->sum(fn($entry) => $entry->debit ?: $entry->credit ?: 0);
        }
        return $this->relations['amount'];
    }

    public function getPaymentStatusAttribute()
    {
        $paymentReference = $this->referenced_by()->whereIn('type', ['payment', 'freight_payment'])->get();
        $paymentVouchersIds = $paymentReference->pluck('voucher_id')->toArray();
        // \Log::info($paymentVouchersIds);
        $paymentVouchers = Voucher::whereIn('id', $paymentVouchersIds)->get();

        $totalPaidAmount = $paymentVouchers->sum(fn($voucher) => $voucher->amount);
        // \Log::info([$this->id, $totalPaidAmount]);
        // return $totalPaidAmount;
        if ($totalPaidAmount >= $this->amount) {
            return 'paid';
        } elseif ($totalPaidAmount > 0) {
            return 'partially_paid';
        } else {
            return 'unpaid';
        }
    }

}
