<?php

namespace App\Modules\JobOrder\Models;

use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobOrder extends Model
{
    use HasFactory;

    protected $table = 'job_orders';

    protected $fillable = [
        "patient_id",
        "voucher_id",
        "employee_id",
        "status",
        "payment_status",
        "priority",
        "booked_date",
        "expected_delivery_date",
        "report_generated_date",
        "report_delivered_date",
        "cancelled_date",
        "report_file_path",
        "remarks"
    ];

    protected $casts = [
 'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function voucher():BelongsTo
    {
        return $this->belongsTo(Voucher::class,'voucher_id');
    }

}
