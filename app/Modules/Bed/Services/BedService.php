<?php

namespace App\Modules\Bed\Services;

use App\Modules\Bed\Contracts\BedServiceInterface;
use App\Modules\Bed\Models\Bed;
use App\Modules\Facility\Contracts\FacilityServiceInterface;
use App\Modules\Facility\Requests\FacilityRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BedService implements BedServiceInterface
{
    protected $resource = [];

    protected $facilityService;

    public function __construct(
        FacilityServiceInterface $facilityService
    ) {
        $this->facilityService = $facilityService;
    }

    public function getAll(): Collection
    {
        return Bed::with($this->resource)->get();
    }

    public function getById(string $id): ?Bed
    {
        return Bed::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Bed
    {
        try {
            DB::beginTransaction();
            $bed = Bed::create($data);
            $facility_request = [
                'status' => 'active',
                'parent_id' => $data['room_id'],
                'facilityable_type' => 'bed',
                'facilityable_id' => $bed->id,
            ];
            $rules = (new FacilityRequest())->rules();
            $validateFacility = Validator::make($facility_request, $rules)->validate();
            $this->facilityService->store($validateFacility);
            DB::commit();
            return $bed;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(array $data, string $id): Bed
    {
        $record = Bed::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Bed::findOrFail($id);
        return $record->delete();
    }
}
