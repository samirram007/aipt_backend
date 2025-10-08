<?php

namespace App\Modules\TestBooking\Models;

use App\Modules\Patient\Models\Patient;
use App\Modules\Voucher\Models\Voucher;
use App\Modules\VoucherPatient\Models\VoucherPatient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TestBooking extends Voucher
{
    use HasFactory;


    public function voucher_patient():HasOne{
        return $this->hasOne(VoucherPatient::class,'voucher_id','id');
    }

}
