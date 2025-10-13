<?php

namespace App\Modules\TestItemReportTemplate\Models;

use App\Modules\Employee\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestItemReportTemplate extends Model
{
    use HasFactory;

    protected $table = 'test_item_report_templates';

    protected $fillable = [
        'stock_item_id',
        'employee_id',
        'report_template_name',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
