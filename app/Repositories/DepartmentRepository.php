<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentRepository
{
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Department::latest()->paginate($perPage);
    }

    public function findById(int $id): ?Department
    {
        return Department::find($id);
    }

    public function create(array $data): Department
    {
        return Department::create($data);
    }

    public function update(Department $department, array $data): bool
    {
        return $department->update($data);
    }

    public function delete(Department $department): bool
    {
        return $department->delete();
    }
}
