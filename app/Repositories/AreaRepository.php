<?php

namespace App\Repositories;

use App\Models\Area;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AreaRepository
{
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Area::with('district.division')->latest()->paginate($perPage);
    }

    public function getByDistrictId(int $districtId): Collection
    {
        return Area::where('district_id', $districtId)->where('status', true)->get();
    }

    public function findById(int $id): ?Area
    {
        return Area::find($id);
    }

    public function create(array $data): Area
    {
        return Area::create($data);
    }

    public function update(Area $area, array $data): bool
    {
        return $area->update($data);
    }

    public function delete(Area $area): bool
    {
        return $area->delete();
    }
}
