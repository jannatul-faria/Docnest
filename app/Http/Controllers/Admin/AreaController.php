<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Services\LocationService;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function __construct(
        protected LocationService $service
    ) {
    }

    public function index()
    {
        $areas = $this->service->getAllAreas();
        return view('admin.locations.areas.index', compact('areas'));
    }

    public function create()
    {
        $divisions = $this->service->getActiveDivisions();
        return view('admin.locations.areas.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255|unique:areas,name',
            'status' => 'required|boolean',
        ]);

        $this->service->createArea($validated);

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area created successfully.');
    }

    public function edit(Area $area)
    {
        $divisions = $this->service->getActiveDivisions();
        $districts = $this->service->getDistrictsByDivision($area->district->division_id);
        return view('admin.locations.areas.edit', compact('area', 'divisions', 'districts'));
    }

    public function update(Request $request, Area $area)
    {
        $validated = $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255|unique:areas,name,' . $area->id,
            'status' => 'required|boolean',
        ]);

        $this->service->updateArea($area, $validated);

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area updated successfully.');
    }

    public function destroy(Area $area)
    {
        $this->service->deleteArea($area);

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area deleted successfully.');
    }

    /**
     * AJAX method to get districts by division
     */
    public function getDistricts(Request $request)
    {
        $districts = $this->service->getDistrictsByDivision($request->division_id);
        return response()->json($districts);
    }

    /**
     * AJAX method to get areas by district
     */
    public function getAreas(Request $request)
    {
        $areas = $this->service->getAreasByDistrict($request->district_id);
        return response()->json($areas);
    }
}
