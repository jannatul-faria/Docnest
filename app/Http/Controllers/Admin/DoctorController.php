<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Department;
use App\Services\DoctorService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct(
        protected DoctorService $service
    ) {}

    public function index()
    {
        $doctors = $this->service->getAllDoctors();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $departments = Department::where('status', true)->get();
        return view('admin.doctors.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'department_id' => 'required|exists:departments,id',
            'specialization' => 'required|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'hospital_name' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'educations' => 'nullable|array',
            'educations.*.degree' => 'required_with:educations|string|max:255',
            'educations.*.institution' => 'required_with:educations|string|max:255',
            'educations.*.passing_year' => 'required_with:educations|string|max:4',
            'experiences' => 'nullable|array',
            'experiences.*.designation' => 'required_with:experiences|string|max:255',
            'experiences.*.institution' => 'required_with:experiences|string|max:255',
            'experiences.*.start_date' => 'required_with:experiences|date',
            'experiences.*.end_date' => 'nullable|date|after_or_equal:experiences.*.start_date',
            'experiences.*.is_current' => 'boolean',
        ]);

        $this->service->createDoctor($validated);

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor profile created successfully.');
    }

    public function show(Doctor $doctor)
    {
        $doctor->load(['user', 'department', 'educations', 'experiences']);
        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $doctor->load(['user', 'department', 'educations', 'experiences']);
        $departments = Department::where('status', true)->get();
        return view('admin.doctors.edit', compact('doctor', 'departments'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $doctor->user_id,
            'password' => 'nullable|string|min:8',
            'department_id' => 'required|exists:departments,id',
            'specialization' => 'required|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'hospital_name' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'educations' => 'nullable|array',
            'experiences' => 'nullable|array',
        ]);

        $this->service->updateDoctor($doctor, $validated);

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor profile updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        $this->service->deleteDoctor($doctor);

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor profile and associated user deleted.');
    }
}
