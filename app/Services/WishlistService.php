<?php

namespace App\Services;

use App\Repositories\WishlistRepository;

class WishlistService
{
    protected $repository;

    public function __construct(WishlistRepository $repository)
    {
        $this->repository = $repository;
    }

    public function toggleWishlist($doctorId)
    {
        return $this->repository->toggle($doctorId);
    }

    public function getUserWishlist($userId)
    {
        return $this->repository->getUserWishlist($userId);
    }

    public function isWishlisted($doctorId)
    {
        return $this->repository->isWishlisted($doctorId);
    }
}
