<?php

namespace App\Modules\FiscalYear\Models;

use App\Enums\ActiveInactive;
use App\Modules\Company\Models\Company;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiscalYear extends Model
{
    use HasFactory, Blamable;

    protected $table = 'fiscal_years';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'status',
        'company_id',
        'assessment_year',

        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => ActiveInactive::class
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
