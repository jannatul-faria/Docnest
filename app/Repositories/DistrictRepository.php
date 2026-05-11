<?php

namespace App\Repositories;

use App\Models\District;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DistrictRepository
{
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return District::with('division')->latest()->paginate($perPage);
    }

    public function getByDivisionId(int $divisionId): Collection
    {
        return District::where('division_id', $divisionId)->where('status', true)->get();
    }

    public function findById(int $id): ?District
    {
        return District::find($id);
    }

    public function create(array $data): District
    {
        return District::create($data);
    }

    public function update(District $district, array $data): bool
    {
        return $district->update($data);
    }

    public function delete(District $district): bool
    {
        return $district->delete();
    }
}
