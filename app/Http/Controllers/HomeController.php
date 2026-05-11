<?php

namespace App\Http\Controllers;
 
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDoctors = Doctor::with(['user', 'department'])
            ->where('is_featured', true)
            ->where('status', true)
            ->take(6)
            ->get();

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

        return view('frontend.index', compact('featuredDoctors', 'departments', 'wishlistedIds'));
    }
}
