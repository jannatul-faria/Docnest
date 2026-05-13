<?php

namespace App\Services;

use App\Models\Chamber;
use App\Repositories\ChamberRepository;
use Illuminate\Support\Facades\DB;

class ChamberService
{
    public function __construct(
        protected ChamberRepository $repository
    ) {}

    public function getAllChambers()
    {
        return $this->repository->getAllPaginated();
    }

    public function createChamber(array $data)
    {
        return DB::transaction(function () use ($data) {
            $chamber = $this->repository->create([
                'doctor_id' => $data['doctor_id'],
                'division_id' => $data['division_id'] ?? null,
                'district_id' => $data['district_id'] ?? null,
                'area_id' => $data['area_id'] ?? null,
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'] ?? true,
            ]);

            if (isset($data['schedules']) && is_array($data['schedules'])) {
                foreach ($data['schedules'] as $schedule) {
                    if (!empty($schedule['day']) && !empty($schedule['start_time'])) {
                        $chamber->schedules()->create($schedule);
                    }
                }
            }

            return $chamber;
        });
    }

    public function updateChamber(Chamber $chamber, array $data)
    {
        return DB::transaction(function () use ($chamber, $data) {
            $this->repository->update($chamber, [
                'doctor_id' => $data['doctor_id'],
                'division_id' => $data['division_id'] ?? null,
                'district_id' => $data['district_id'] ?? null,
                'area_id' => $data['area_id'] ?? null,
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'] ?? true,
            ]);

            if (isset($data['schedules']) && is_array($data['schedules'])) {
                $chamber->schedules()->delete();
                foreach ($data['schedules'] as $schedule) {
                    if (!empty($schedule['day']) && !empty($schedule['start_time'])) {
                        $chamber->schedules()->create($schedule);
                    }
                }
            }

            return $chamber;
        });
    }

    public function deleteChamber(Chamber $chamber)
    {
        return $this->repository->delete($chamber);
    }
}
