<?php

namespace App\Modules\BomDetail\Services;

use App\Modules\BomDetail\Contracts\BomDetailServiceInterface;
use App\Modules\BomDetail\Models\BomDetail;
use Illuminate\Database\Eloquent\Collection;

class BomDetailService implements BomDetailServiceInterface
{
    protected $resource=['bom','stockItem'];

    public function getAll(): Collection
    {
        return BomDetail::with($this->resource)->get();
    }

    public function getById(int $id): ?BomDetail
    {
        return BomDetail::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): BomDetail
    {
        // dd($data);
        foreach($data['details'] as $detail){
            $detail['bom_id']=$data['bom_id'];
            BomDetail::create($detail);
        }
        return null;
        // return BomDetail::create($data);
    }

    public function update(array $data, int $id): BomDetail
    {
        $record = BomDetail::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = BomDetail::findOrFail($id);
        return $record->delete();
    }
}