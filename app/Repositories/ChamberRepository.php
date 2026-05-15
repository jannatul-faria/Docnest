<?php

namespace App\Repositories;

use App\Models\Chamber;
use Illuminate\Pagination\LengthAwarePaginator;

class ChamberRepository
{
    public function getAllPaginated(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Chamber::with(['doctor.user', 'area.district.division'])->latest();

        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('address', 'like', '%' . $filters['search'] . '%')
                  ->orWhereHas('doctor.user', function ($sq) use ($filters) {
                      $sq->where('name', 'like', '%' . $filters['search'] . '%');
                  });
            });
        }

        return $query->paginate($perPage)->withQueryString();
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
