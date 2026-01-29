<?php

namespace App\Modules\Floor\Services;

use App\Modules\Facility\Contracts\FacilityServiceInterface;
use App\Modules\Facility\Requests\FacilityRequest;
use App\Modules\Floor\Contracts\FloorServiceInterface;
use App\Modules\Floor\Models\Floor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FloorService implements FloorServiceInterface
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
        return Floor::with($this->resource)->get();
    }

    public function getById(string $id): ?Floor
    {
        return Floor::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Floor
    {
        try {
            DB::beginTransaction();
            $floor = Floor::create($data);
            $facility_request = [
                'status' => 'active',
                'parent_id' => $data['building_id'],
                'facilityable_type' => 'floor',
                'facilityable_id' => $floor->id,
            ];
            $rules = (new FacilityRequest())->rules();
            $validateFacility = Validator::make($facility_request, $rules)->validate();
            $this->facilityService->store($validateFacility);
            DB::commit();
            return $floor;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(array $data, string $id): Floor
    {
        $record = Floor::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Floor::findOrFail($id);
        return $record->delete();
    }
}
