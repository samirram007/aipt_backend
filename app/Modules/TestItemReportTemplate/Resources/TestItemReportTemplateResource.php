<?php

namespace App\Modules\TestItemReportTemplate\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\Doctor\Resources\DoctorResource;
use App\Modules\TestItem\Resources\TestItemResource;

class TestItemReportTemplateResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'testItemId' => $this->test_item_id,
            'doctorId' => $this->doctor_id,
            'reportTemplateName' => $this->report_template_name,
            'testItem' => TestItemResource::make($this->whenLoaded('test_item')),
            'doctor' => DoctorResource::make($this->whenLoaded('doctor')),
        ];
    }
}
