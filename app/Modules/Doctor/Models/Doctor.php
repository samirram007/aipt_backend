<?php

namespace App\Modules\Doctor\Models;

use App\Modules\Employee\Models\Employee;
use App\Modules\TestItemReportTemplate\Models\TestItemReportTemplate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Employee
{
    use HasFactory;

    public function test_item_report_templates():HasMany
    {
        return $this->hasMany(TestItemReportTemplate::class,'doctor_id','id');
    }

}
