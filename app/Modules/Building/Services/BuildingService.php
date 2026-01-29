<?php

namespace App\Modules\Building\Services;

use App\Modules\Building\Contracts\BuildingServiceInterface;
use App\Modules\Building\Models\Building;
use App\Modules\Facility\Contracts\FacilityServiceInterface;
use App\Modules\Facility\Requests\FacilityRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BuildingService implements BuildingServiceInterface
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
        return Building::with($this->resource)->get();
    }

    public function getById(string $id): ?Building
    {
        return Building::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Building
    {
        try {
            DB::beginTransaction();
            $building = Building::create($data);

            $facility_request = [
                'status' => 'active',
                'parent_id' => null,
                'facilityable_type' => 'building',
                'facilityable_id' => $building->id,
            ];

            $rules = (new FacilityRequest())->rules();
            $validatedFacility = Validator::make($facility_request, $rules)->validate();
            $this->facilityService->store($validatedFacility);
            DB::commit();
            return $building;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(array $data, string $id): Building
    {
        $record = Building::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Building::findOrFail($id);
        return $record->delete();
    }
}
