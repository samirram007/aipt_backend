<?php

namespace App\Modules\TestItemReportTemplate\Models;

use App\Modules\Doctor\Models\Doctor;
use App\Modules\TestItem\Models\TestItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestItemReportTemplate extends Model
{
    use HasFactory;

    protected $table = 'test_item_report_templates';

    protected $fillable = [
        'test_item_id',
        'doctor_id',
        'report_template_name',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }
    public function test_item(): BelongsTo
    {
        return $this->belongsTo(TestItem::class,'test_item_id','id');
    }

}
