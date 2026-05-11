<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Services\LocationService;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function __construct(
        protected LocationService $service
    ) {}

    public function index()
    {
        $districts = $this->service->getAllDistricts();
        return view('admin.locations.districts.index', compact('districts'));
    }

    public function create()
    {
        $divisions = $this->service->getActiveDivisions();
        return view('admin.locations.districts.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255|unique:districts,name',
            'status' => 'required|boolean',
        ]);

        $this->service->createDistrict($validated);

        return redirect()->route('districts.index')
            ->with('success', 'District created successfully.');
    }

    public function edit(District $district)
    {
        $divisions = $this->service->getActiveDivisions();
        return view('admin.locations.districts.edit', compact('district', 'divisions'));
    }

    public function update(Request $request, District $district)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255|unique:districts,name,' . $district->id,
            'status' => 'required|boolean',
        ]);

        $this->service->updateDistrict($district, $validated);

        return redirect()->route('districts.index')
            ->with('success', 'District updated successfully.');
    }

    public function destroy(District $district)
    {
        $this->service->deleteDistrict($district);

        return redirect()->route('districts.index')
            ->with('success', 'District deleted successfully.');
    }
}
