<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DoctorDiscoveryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/departments', [HomeController::class, 'departments'])->name('departments.index');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/doctors', [DoctorDiscoveryController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{id}', [DoctorDiscoveryController::class, 'show'])->name('doctors.show');

// Public Location AJAX
Route::get('/api/districts', function(\Illuminate\Http\Request $request) {
    return \App\Models\District::where('division_id', $request->division_id)->orderBy('name')->get();
});
Route::get('/api/areas', function(\Illuminate\Http\Request $request) {
    return \App\Models\Area::where('district_id', $request->district_id)->orderBy('name')->get();
});

Route::get('/api/locations/search', function(\Illuminate\Http\Request $request) {
    $query = $request->query('query');
    if (!$query) return [];

    $results = [];

    // Search Divisions
    $divisions = \App\Models\Division::where('name', 'like', "%$query%")
        ->take(5)
        ->get();
    foreach($divisions as $div) {
        $results[] = [
            'id' => $div->id,
            'name' => $div->name,
            'type' => 'division',
            'display' => $div->name . ' (Division)'
        ];
    }

    // Search Districts
    $districts = \App\Models\District::with('division')
        ->where('name', 'like', "%$query%")
        ->take(5)
        ->get();
    foreach($districts as $dist) {
        $results[] = [
            'id' => $dist->id,
            'name' => $dist->name,
            'type' => 'district',
            'display' => $dist->name . ', ' . $dist->division->name . ' (District)'
        ];
    }

    // Search Areas
    $areas = \App\Models\Area::with('district.division')
        ->where('name', 'like', "%$query%")
        ->take(10)
        ->get();
    foreach($areas as $area) {
        $results[] = [
            'id' => $area->id,
            'name' => $area->name,
            'type' => 'area',
            'display' => $area->name . ', ' . $area->district->name . ' (Area)'
        ];
    }

    return response()->json($results);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', 'App\Http\Controllers\WishlistController@index')->name('wishlist.index');
    Route::post('/wishlist/toggle', 'App\Http\Controllers\WishlistController@toggle')->name('wishlist.toggle');
    Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('super-admin')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('patient.dashboard');
    })->name('dashboard');

    Route::get('/my-profile', function() {
        return view('frontend.patient.dashboard');
    })->name('patient.dashboard');

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('departments', \App\Http\Controllers\DepartmentController::class);

    // Location Management
    Route::resource('divisions', \App\Http\Controllers\Admin\DivisionController::class);
    Route::resource('districts', \App\Http\Controllers\Admin\DistrictController::class);
    Route::resource('areas', \App\Http\Controllers\Admin\AreaController::class);
    Route::get('get-districts', [\App\Http\Controllers\Admin\AreaController::class, 'getDistricts'])->name('get-districts');

    // Doctor Management
    Route::resource('doctors', \App\Http\Controllers\Admin\DoctorController::class);

    // Chamber Management
    Route::resource('chambers', \App\Http\Controllers\Admin\ChamberController::class);
    Route::get('get-areas', [\App\Http\Controllers\Admin\AreaController::class, 'getAreas'])->name('get-areas');

    // Review Management
    Route::get('reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::patch('reviews/{review}/toggle', [\App\Http\Controllers\Admin\ReviewController::class, 'toggleStatus'])->name('reviews.toggle');
    Route::delete('reviews/{review}', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');

    // User Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);

    // Activity Logs
    Route::get('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');

    // Site Settings
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';