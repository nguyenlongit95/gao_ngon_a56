<?php

namespace App\Repositories\Wishlist;

use App\Models\Wishlist;
use App\Repositories\Eloquent\EloquentRepository;

class WishListEloquentRepository extends EloquentRepository implements WishListRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Wishlist::class;
    }
}
