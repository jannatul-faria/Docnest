<?php

namespace App\Repositories;

use App\Models\Division;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DivisionRepository
{
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Division::latest()->paginate($perPage);
    }

    public function getAllActive(): Collection
    {
        return Division::where('status', true)->get();
    }

    public function findById(int $id): ?Division
    {
        return Division::find($id);
    }

    public function create(array $data): Division
    {
        return Division::create($data);
    }

    public function update(Division $division, array $data): bool
    {
        return $division->update($data);
    }

    public function delete(Division $division): bool
    {
        return $division->delete();
    }
}
