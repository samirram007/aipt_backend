<?php

namespace App\Modules\Doctor\Services;

use App\Modules\Doctor\Contracts\DoctorServiceInterface;
use App\Modules\Doctor\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;
use App\Modules\User\Models\User;
use App\Modules\UserRole\Models\UserRole;
use App\Modules\Address\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorService implements DoctorServiceInterface
{
    protected $resource=['department','designation'];

    public function getAll(): Collection
    {
        return Doctor::with($this->resource)->get();
    }

    public function getById(int $id): ?Doctor
    {
        return Doctor::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Doctor
    {
        // dd($data);
        try {
            DB::beginTransaction();
             $doctor = Doctor::create($data);

        if (!empty($data['address'])) {

            $data['address']['address_type'] = 'hospital';
            $data['address']['addressable_type'] = 'doctor';
            $data['address']['addressable_id'] = $doctor->id;

            $doctor->address()->create($data['address']);
        }

        if (!empty($data['has_user_account']) && !empty($data['email'])) {
            if (!User::where('username', $data['email'])->exists()) {
                 $user = $doctor->user()->create([
                    'name'          => $doctor->name,
                    'email'         => $doctor->email,
                    'username'      => $doctor->email,
                    'user_type'     => 'user',
                    'password'      => bcrypt('password'),
                    'userable_type' => 'doctor',
                    'userable_id'   => $doctor->id,
                    'status'        => 'active',
                ]);

                if(!empty($data['role_id'])){
                    UserRole::create([
                        'user_id' => $user->id,
                        'role_id' => $data['role_id'],
                    ]);
                }
            }
        }
            DB::commit();
            return $doctor->load($this->resource);

        } catch (\Exception $th) {Log::error('Test Refund error: ' . $th->getMessage(), ['trace' => $th->getTraceAsString()]);
            DB::rollBack();
            throw new Exception("Error Processing Request", 1);
        }

    }

    public function update(array $data, int $id): Doctor
    {
        $record = Doctor::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Doctor::findOrFail($id);
        return $record->delete();
    }
}