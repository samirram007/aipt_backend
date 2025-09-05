<?php

namespace App\Modules\Company\Models;

use App\Modules\CompanyType\Models\CompanyType;
use App\Modules\FiscalYear\Models\FiscalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'code',
        'description',
        'company_type_id',
        'fiscal_year_id',
        'address',
        'phone',
        'email',
        'website',
        'logo',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function companyType():BelongsTo
    {
        return $this->belongsTo(CompanyType::class);
    }
    public function fiscalYear():BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }
}
