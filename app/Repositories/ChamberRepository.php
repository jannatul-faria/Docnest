<?php

namespace App\Repositories;

use App\Models\Chamber;
use Illuminate\Pagination\LengthAwarePaginator;

class ChamberRepository
{
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Chamber::with(['doctor.user', 'area.district.division'])
            ->latest()
            ->paginate($perPage);
    }

    public function findById(int $id): ?Chamber
    {
        return Chamber::with(['doctor.user', 'area.district.division', 'schedules'])->find($id);
    }

    public function create(array $data): Chamber
    {
        return Chamber::create($data);
    }

    public function update(Chamber $chamber, array $data): bool
    {
        return $chamber->update($data);
    }

    public function delete(Chamber $chamber): bool
    {
        return $chamber->delete();
    }
}
