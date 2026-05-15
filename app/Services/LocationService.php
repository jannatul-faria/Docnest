<?php

namespace App\Services;

use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Repositories\AreaRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\DivisionRepository;
use Illuminate\Support\Str;

class LocationService
{
    public function __construct(
        protected DivisionRepository $divisionRepository,
        protected DistrictRepository $districtRepository,
        protected AreaRepository $areaRepository
    ) {
    }

    // Division Methods
    public function getAllDivisions()
    {
        return $this->divisionRepository->getAllPaginated();
    }

    public function createDivision(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->divisionRepository->create($data);
    }

    public function updateDivision(Division $division, array $data)
    {
        if (isset($data['name']) && $data['name'] !== $division->name) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->divisionRepository->update($division, $data);
    }

    public function deleteDivision(Division $division)
    {
        return $this->divisionRepository->delete($division);
    }

    // District Methods
    public function getAllDistricts()
    {
        return $this->districtRepository->getAllPaginated();
    }

    public function createDistrict(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->districtRepository->create($data);
    }

    public function updateDistrict(District $district, array $data)
    {
        if (isset($data['name']) && $data['name'] !== $district->name) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->districtRepository->update($district, $data);
    }

    public function deleteDistrict(District $district)
    {
        return $this->districtRepository->delete($district);
    }

    // Area Methods
    public function getAllAreas()
    {
        return $this->areaRepository->getAllPaginated();
    }

    public function createArea(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->areaRepository->create($data);
    }

    public function updateArea(Area $area, array $data)
    {
        if (isset($data['name']) && $data['name'] !== $area->name) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->areaRepository->update($area, $data);
    }

    public function deleteArea(Area $area)
    {
        return $this->areaRepository->delete($area);
    }

    // Helpers
    public function getActiveDivisions()
    {
        return $this->divisionRepository->getAllActive();
    }

    public function getDistrictsByDivision(int $divisionId)
    {
        return $this->districtRepository->getByDivisionId($divisionId);
    }

    public function getAreasByDistrict(int $districtId)
    {
        return $this->areaRepository->getByDistrictId($districtId);
    }
}
