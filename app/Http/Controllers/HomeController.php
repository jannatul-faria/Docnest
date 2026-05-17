<?php

namespace App\Http\Controllers;
 
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Division;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDoctors = Doctor::with(['user', 'department', 'chambers.area.district'])
            ->where('is_featured', true)
            ->where('status', true)
            ->take(8)
            ->get();

        $totalDoctorsCount = Doctor::where('status', true)->count();

        $departments = Department::withCount('doctors')
            ->orderBy('doctors_count', 'desc')
            ->take(8)
            ->get();

        $wishlistedIds = [];
        if (Auth::check()) {
            $wishlistedIds = Wishlist::where('user_id', Auth::id())
                ->pluck('doctor_id')
                ->toArray();
        }

        $divisions = Division::orderBy('name')->get();

        return view('frontend.index', compact('featuredDoctors', 'totalDoctorsCount', 'departments', 'wishlistedIds', 'divisions'));
    }

    public function departments()
    {
        $departments = Department::withCount(['doctors' => function ($query) {
            $query->where('status', true);
        }])
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('frontend.departments.index', compact('departments'));
    }

    public function about()
    {
        return view('frontend.about');
    }
}
