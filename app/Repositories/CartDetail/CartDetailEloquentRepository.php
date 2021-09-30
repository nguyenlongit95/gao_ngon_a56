<?php

namespace App\Repositories\CartDetail;

use App\Models\CartDetail;
use App\Repositories\Eloquent\EloquentRepository;

class CartDetailEloquentRepository extends EloquentRepository implements CartDetailRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CartDetail::class;
    }
}
