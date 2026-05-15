<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\District;
use App\Models\Area;
use App\Models\Wishlist;
use App\Services\DoctorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorDiscoveryController extends Controller
{
    public function __construct(
        protected DoctorService $doctorService
    ) {}

    public function index(Request $request)
    {
        $filters = $request->only([
            'search', 'department_id', 'division_id', 'district_id', 'area_id', 
            'min_fee', 'max_fee', 'min_experience', 'sort'
        ]);

        $doctors = $this->doctorService->filterDoctors($filters);
        $departments = Department::withCount('doctors')->orderBy('name')->get();
        $divisions = Division::orderBy('name')->get();

        $wishlistedIds = [];
        if (Auth::check()) {
            $wishlistedIds = Wishlist::where('user_id', Auth::id())
                ->pluck('doctor_id')
                ->toArray();
        }

        if ($request->has('partial')) {
            return response()->view('frontend.doctors._list', compact('doctors', 'wishlistedIds'))
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0')
                ->header('Vary', 'X-Partial-Request');
        }

        return view('frontend.doctors.index', compact('doctors', 'departments', 'divisions', 'wishlistedIds', 'filters'));
    }

    public function show($id)
    {
        $doctor = \App\Models\Doctor::with([
            'user', 
            'department', 
            'educations', 
            'experiences', 
            'chambers.area.district.division', 
            'chambers.schedules',
            'reviews.user'
        ])->findOrFail($id);

        $wishlistedIds = [];
        if (Auth::check()) {
            $wishlistedIds = Wishlist::where('user_id', Auth::id())
                ->pluck('doctor_id')
                ->toArray();
        }

        return view('frontend.doctors.show', compact('doctor', 'wishlistedIds'));
    }
}
