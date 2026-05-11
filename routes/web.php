<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DoctorDiscoveryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/doctors', [DoctorDiscoveryController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{id}', [DoctorDiscoveryController::class, 'show'])->name('doctors.show');

// Public Location AJAX
Route::get('/api/districts', function(\Illuminate\Http\Request $request) {
    return \App\Models\District::where('division_id', $request->division_id)->orderBy('name')->get();
});
Route::get('/api/areas', function(\Illuminate\Http\Request $request) {
    return \App\Models\Area::where('district_id', $request->district_id)->orderBy('name')->get();
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
    Route::get('get-areas', function(\Illuminate\Http\Request $request) {
        return \App\Models\Area::where('district_id', $request->district_id)->get();
    })->name('get-areas');

    // Review Management
    Route::get('reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::patch('reviews/{review}/toggle', [\App\Http\Controllers\Admin\ReviewController::class, 'toggleStatus'])->name('reviews.toggle');
    Route::delete('reviews/{review}', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Activity Logs
    Route::get('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
});

require __DIR__.'/auth.php';