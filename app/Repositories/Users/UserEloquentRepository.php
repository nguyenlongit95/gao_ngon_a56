<?php

namespace App\Repositories\Users;

use App\User;
use App\Repositories\Eloquent\EloquentRepository;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryinterface
{
    const ARR_RELATION_CUSTOMER = ['carts', 'wishlist', 'ratting'];
    /**
     * @return mixed
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * Function list customer and relations
     *
     * @return mixed
     */
    public function listCustomer()
    {
        return \App\Models\User::where('role', config('const.users.customer'))->orderBy('id', 'DESC')
            ->with(self::ARR_RELATION_CUSTOMER)
            ->paginate(config('const.paginate'));
    }

    /**
     * SQL function list relationship and find an customer
     *
     * @param int $id of customer
     * @return mixed
     */
    public function findCustomer($id)
    {
        return \App\Models\User::with(['carts' => function ($query) {
            $query->with('cartDetail');
        }, 'ratting' => function ($query) {
            $query->join('products', 'product_id', 'products.id');
        }, 'wishlist' => function ($query) {
            $query->join('products', 'product_id', 'products.id');
        }])->findOrFail($id);
    }
}
