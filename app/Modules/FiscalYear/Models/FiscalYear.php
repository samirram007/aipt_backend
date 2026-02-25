<?php

namespace App\Modules\FiscalYear\Models;

use App\Enums\ActiveInactive;
use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiscalYear extends Model
{
    use HasFactory;

    protected $table = 'fiscal_years';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'status',
        'company_id',
        'assessment_year'


    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => ActiveInactive::class
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
