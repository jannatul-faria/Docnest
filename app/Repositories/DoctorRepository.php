<?php

namespace App\Repositories;

use App\Models\Doctor;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorRepository
{
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Doctor::with(['user', 'department'])
            ->latest()
            ->paginate($perPage);
    }

    public function filter(array $filters, int $perPage = 9): LengthAwarePaginator
    {
        $query = Doctor::with(['user', 'department', 'media'])
            ->where('status', true);

        // Search by Name
        if (!empty($filters['search'])) {
            $query->whereHas('user', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Filter by Department
        if (!empty($filters['department_id'])) {
            $query->where('department_id', $filters['department_id']);
        }

        // Filter by Location (via Chambers)
        if (!empty($filters['area_id']) || !empty($filters['district_id']) || !empty($filters['division_id'])) {
            $query->whereHas('chambers', function ($q) use ($filters) {
                if (!empty($filters['area_id'])) {
                    $q->where('area_id', $filters['area_id']);
                } elseif (!empty($filters['district_id'])) {
                    $q->whereHas('area', function ($sq) use ($filters) {
                        $sq->where('district_id', $filters['district_id']);
                    });
                } elseif (!empty($filters['division_id'])) {
                    $q->whereHas('area.district', function ($sq) use ($filters) {
                        $sq->where('division_id', $filters['division_id']);
                    });
                }
            });
        }

        // Filter by Fee
        if (!empty($filters['min_fee'])) {
            $query->where('consultation_fee', '>=', $filters['min_fee']);
        }
        if (!empty($filters['max_fee'])) {
            $query->where('consultation_fee', '<=', $filters['max_fee']);
        }

        // Filter by Experience
        if (!empty($filters['min_experience'])) {
            $query->where('experience_years', '>=', $filters['min_experience']);
        }

        // Sorting
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price_low':
                    $query->orderBy('consultation_fee', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('consultation_fee', 'desc');
                    break;
                case 'experience':
                    $query->orderBy('experience_years', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function findById(int $id): ?Doctor
    {
        return Doctor::with(['user', 'department', 'educations', 'experiences'])->find($id);
    }

    public function create(array $data): Doctor
    {
        return Doctor::create($data);
    }

    public function update(Doctor $doctor, array $data): bool
    {
        return $doctor->update($data);
    }

    public function delete(Doctor $doctor): bool
    {
        return $doctor->delete();
    }
}
