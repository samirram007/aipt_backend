<?php

namespace App\Modules\Room\Services;

use App\Modules\Facility\Contracts\FacilityServiceInterface;
use App\Modules\Facility\Requests\FacilityRequest;
use App\Modules\Room\Contracts\RoomServiceInterface;
use App\Modules\Room\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomService implements RoomServiceInterface
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
        return Room::with($this->resource)->get();
    }

    public function getById(string $id): ?Room
    {
        return Room::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Room
    {
        try {
            DB::beginTransaction();
            $room = Room::create($data);
            $facility_request = [
                'status' => 'active',
                'parent_id' => $data['floor_id'],
                'facilityable_type' => 'room',
                'facilityable_id' => $room->id,
            ];
            $rules = (new FacilityRequest())->rules();
            $validateFacility = Validator::make($facility_request, $rules)->validate();
            $this->facilityService->store($validateFacility);
            DB::commit();
            return $room;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(array $data, string $id): Room
    {
        $record = Room::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Room::findOrFail($id);
        return $record->delete();
    }
}
