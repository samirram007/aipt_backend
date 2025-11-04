<?php

namespace App\Modules\Godown\Services;

use App\Modules\Godown\Contracts\GodownServiceInterface;
use App\Modules\Godown\Models\Godown;
use Illuminate\Database\Eloquent\Collection;

class GodownService implements GodownServiceInterface
{
    protected $resource = ['parent', 'address'];

    public function getAll(): Collection
    {
        $data = Godown::with($this->resource)->get();
        //dd($data->toArray());
        return $data;
        // return Godown::get()->load($this->resource);
    }

    public function getById(int $id): ?Godown
    {
        // dd(Godown::with($this->resource)->findOrFail($id));
        return Godown::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Godown
    {
        if (empty($data['code'])) {

            $data['code'] = Godown::getUniqueCode();
            //dd($data);
        }

        $godown = Godown::create($data);
        // dd($data);
        if ($data['address']) {
            if (empty($data['address']['is_primary'])) {
                $data['address']['is_primary'] = false;
            }
            $data['address']['address_type'] = 'office';
            $data['address']['addressable_type'] = 'godown';
            $data['address']['addressable_id'] = $godown->id;

            $godown->address()->create($data['address']);
        }


        return $godown->load($this->resource);
    }

    public function update(array $data, int $id): Godown
    {
        if (empty($data['code'])) {
            $data['code'] = $this->getUniqueCode();
        }
        $godown = Godown::findOrFail($id);

        $godown->update($data);

        if (isset($data['address'])) {
            if (empty($data['address']['is_primary'])) {
                $data['address']['is_primary'] = false;
            }
            $data['address']['address_type'] = 'office';
            $data['address']['addressable_type'] = 'godown';
            $data['address']['addressable_id'] = $godown->id;
            if (!empty($data['address']['id'])) {
                $address = $godown->address()->find($data['address']['id']);
                // dd($address);
                $address?->update($data['address']);
            } else {
                $godown->address()->create($data['address']);
            }
        }


        return $godown->fresh()->load($this->resource);
    }

    public function delete(int $id): bool
    {
        $record = Godown::findOrFail($id);
        return $record->delete();
    }
}
