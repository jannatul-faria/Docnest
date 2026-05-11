<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chamber;
use App\Models\Doctor;
use App\Models\Division;
use App\Services\ChamberService;
use Illuminate\Http\Request;

class ChamberController extends Controller
{
    public function __construct(
        protected ChamberService $service
    ) {}

    public function index()
    {
        $chambers = $this->service->getAllChambers();
        return view('admin.chambers.index', compact('chambers'));
    }

    public function create()
    {
        $doctors = Doctor::with('user')->where('status', true)->get();
        $divisions = Division::all();
        return view('admin.chambers.create', compact('doctors', 'divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'area_id' => 'required|exists:areas,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|boolean',
            'schedules' => 'nullable|array',
            'schedules.*.day' => 'required_with:schedules|string',
            'schedules.*.start_time' => 'required_with:schedules',
            'schedules.*.end_time' => 'required_with:schedules|after:schedules.*.start_time',
            'schedules.*.max_patients' => 'nullable|integer|min:1',
        ]);

        $this->service->createChamber($validated);

        return redirect()->route('chambers.index')
            ->with('success', 'Chamber created successfully.');
    }

    public function edit(Chamber $chamber)
    {
        $chamber->load(['schedules', 'area.district.division']);
        $doctors = Doctor::with('user')->where('status', true)->get();
        $divisions = Division::all();
        
        // Pre-load districts and areas for the current chamber's location
        $districts = \App\Models\District::where('division_id', $chamber->area->district->division_id)->get();
        $areas = \App\Models\Area::where('district_id', $chamber->area->district_id)->get();

        return view('admin.chambers.edit', compact('chamber', 'doctors', 'divisions', 'districts', 'areas'));
    }

    public function update(Request $request, Chamber $chamber)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'area_id' => 'required|exists:areas,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|boolean',
            'schedules' => 'nullable|array',
        ]);

        $this->service->updateChamber($chamber, $validated);

        return redirect()->route('chambers.index')
            ->with('success', 'Chamber updated successfully.');
    }

    public function destroy(Chamber $chamber)
    {
        $this->service->deleteChamber($chamber);

        return redirect()->route('chambers.index')
            ->with('success', 'Chamber deleted successfully.');
    }
}
