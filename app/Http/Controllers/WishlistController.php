<?php

namespace App\Http\Controllers;

use App\Services\WishlistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    protected $service;

    public function __construct(WishlistService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $wishlists = $this->service->getUserWishlist(Auth::id());
        return view('frontend.wishlist', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $result = $this->service->toggleWishlist($request->doctor_id);
        return response()->json($result);
    }
}
