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
            foreach ($data['beds'] as $bed) {
                $create = Bed::create($bed);
                $facility_request = [
                    'status' => 'active',
                    'parent_id' => $bed['room_id'],
                    'facilityable_type' => 'bed',
                    'facilityable_id' => $create->id,
                ];
                $rules = (new FacilityRequest())->rules();
                $validatedFacility = Validator::make($facility_request, $rules)->validate();
                $this->facilityService->store($validatedFacility);
            }
            DB::commit();
            $createdBed = Bed::first();
            return $createdBed;
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
