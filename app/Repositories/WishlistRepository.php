<?php

namespace App\Repositories;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistRepository
{
    public function toggle($doctorId)
    {
        $userId = Auth::id();
        $wishlist = Wishlist::where('user_id', $userId)
            ->where('doctor_id', $doctorId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return ['status' => 'removed'];
        }

        Wishlist::create([
            'user_id' => $userId,
            'doctor_id' => $doctorId
        ]);

        return ['status' => 'added'];
    }

    public function getUserWishlist($userId)
    {
        return Wishlist::with(['doctor.user', 'doctor.department', 'doctor.chambers.area.district'])
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }

    public function isWishlisted($doctorId)
    {
        if (!Auth::check()) return false;
        
        return Wishlist::where('user_id', Auth::id())
            ->where('doctor_id', $doctorId)
            ->exists();
    }
}
