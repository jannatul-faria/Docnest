<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Services\LocationService;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function __construct(
        protected LocationService $service
    ) {
    }

    public function index()
    {
        $divisions = $this->service->getAllDivisions();
        return view('admin.locations.divisions.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.locations.divisions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name',
            'status' => 'required|boolean',
        ]);

        $this->service->createDivision($validated);

        return redirect()->route('admin.divisions.index')
            ->with('success', 'Division created successfully.');
    }

    public function edit(Division $division)
    {
        return view('admin.locations.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name,' . $division->id,
            'status' => 'required|boolean',
        ]);

        $this->service->updateDivision($division, $validated);

        return redirect()->route('admin.divisions.index')
            ->with('success', 'Division updated successfully.');
    }

    public function destroy(Division $division)
    {
        $this->service->deleteDivision($division);

        return redirect()->route('admin.divisions.index')
            ->with('success', 'Division deleted successfully.');
    }
}
