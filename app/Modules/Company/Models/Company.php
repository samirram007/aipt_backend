<?php

namespace App\Modules\Company\Models;

use App\Modules\CompanyType\Models\CompanyType;
use App\Modules\Country\Models\Country;
use App\Modules\Currency\Models\Currency;
use App\Modules\FiscalYear\Models\FiscalYear;
use App\Modules\State\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'code',
        'description',
        'company_type_id',
        'phone_no',
        'mobile_no',
        'email',
        'website',
        'cin_no',
        'tin_no',
        'tan_no',
        'gst_no',
        'pan_no',
        'logo',
        'currency_id',
        'address',
        'country_id',
        'state_id',
        'city',
        'zip_code',
        'status',
        'is_group_company',
    ];

    protected $casts = [
 'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_group_company' => 'boolean',
    ];

    public function company_type(): BelongsTo
    {
        return $this->belongsTo(CompanyType::class);
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
    public function fiscal_years(): HasMany
    {
        return $this->hasMany(FiscalYear::class);
    }
}
