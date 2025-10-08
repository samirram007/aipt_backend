<?php

namespace App\Modules\VoucherPatient\Models;

use App\Modules\Address\Models\Address;
use App\Modules\Agent\Models\Agent;
use App\Modules\Patient\Models\Patient;
use App\Modules\Physician\Models\Physician;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherPatient extends Model
{
    use HasFactory;

    protected $table = 'voucher_patients';

    protected $fillable = [
        'voucher_id',
        'patient_id',
        'agent_id',
        'physician_id',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function voucher():BelongsTo{
        return $this->belongsTo(Voucher::class,'voucher_id','id');
    }
    public function patient():BelongsTo{
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function agent():BelongsTo{
        return $this->belongsTo(Agent::class,'agent_id','id');
    }
    public function physician():BelongsTo{
        return $this->belongsTo(Physician::class,'physician_id','id');
    }
}
