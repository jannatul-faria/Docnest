<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_departments' => \App\Models\Department::count(),
            'total_doctors' => \App\Models\Doctor::count(),
            'total_reviews' => \App\Models\Review::count(),
            'total_locations' => \App\Models\Area::count(),
        ];

        $recent_reviews = \App\Models\Review::with(['user', 'doctor.user'])
            ->latest()
            ->take(5)
            ->get();

        $recent_doctors = \App\Models\Doctor::with(['user', 'department'])
            ->latest()
            ->take(5)
            ->get();

        $recent_activities = \Spatie\Activitylog\Models\Activity::with('causer')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_reviews', 'recent_doctors', 'recent_activities'));
    }
}
