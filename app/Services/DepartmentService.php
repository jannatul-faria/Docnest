<?php

namespace App\Services;

use App\Models\Department;
use App\Repositories\DepartmentRepository;
use Illuminate\Support\Str;

class DepartmentService
{
    public function __construct(
        protected DepartmentRepository $repository
    ) {}

    public function getAllDepartments()
    {
        return $this->repository->getAllPaginated();
    }

    public function createDepartment(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        
        // Handle image upload logic here if using Spatie Media Library
        // For now, we'll just create the record
        
        return $this->repository->create($data);
    }

    public function updateDepartment(Department $department, array $data)
    {
        if (isset($data['name']) && $data['name'] !== $department->name) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $this->repository->update($department, $data);
    }

    public function deleteDepartment(Department $department)
    {
        return $this->repository->delete($department);
    }
}
