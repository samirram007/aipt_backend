<?php

namespace App\Modules\UserFiscalYear\Models;

use App\Modules\FiscalYear\Models\FiscalYear;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFiscalYear extends Model
{
    use HasFactory;

    protected $table = 'user_fiscal_years';

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'fiscal_year_id',
        'start_date',
        'end_date',
        'current_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'current_date' => 'date',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function fiscal_year(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id', 'id');
    }
}
