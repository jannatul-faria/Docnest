<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Check if user already reviewed this doctor
        $exists = Review::where('user_id', Auth::id())
            ->where('doctor_id', $request->doctor_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already reviewed this doctor.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => true, // Auto approve for now
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}
