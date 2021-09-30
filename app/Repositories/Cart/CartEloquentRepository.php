<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Repositories\Eloquent\EloquentRepository;

class CartEloquentRepository extends EloquentRepository implements CartRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Cart::class;
    }

    /**
     * Function list all card and join to table users
     *
     * @return mixed
     */
    public function getListCart()
    {
        return Cart::join('users', 'cart.user_id', 'users.id')
            ->select(
                'cart.id', 'cart.code', 'cart.amount', 'cart.status', 'cart.state', 'cart.address',
                'users.name', 'users.email'
            )->orderBy('cart.id', 'DESC')->paginate(config('const.paginate'));
    }

    /**
     * Function add more and replace attribute of cart
     *
     * @param  object list $carts
     * @return mixed
     */
    public function addOnAttribute($carts)
    {
        if (!isset($carts) || empty($carts)) {
            return null;
        }

        foreach ($carts as $cart) {
            $cart->status = $this->replaceStatus($cart);
            $cart->state = $this->replaceState($cart);
        }

        return $carts;
    }

    /**
     * function replace status of cart
     *
     * @param object $cart 0 draft 1 unCharge 2 charged
     * @return mixed
     */
    public function replaceStatus($cart)
    {
        if (key_exists($cart->status, config('const.orders_status'))) {
            return config('const.orders_status')[$cart->status];
        }
    }

    /**
     * Function replace state of cart
     *
     * @param object $cart 1: Đơn hàng đang xử lý 2: đơn hàng đã huỷ 0: đơn hàng đã giao
     * @return string
     */
    public function replaceState($cart)
    {
        if (key_exists($cart->state, config('const.orders_state'))) {
            return config('const.orders_state')[$cart->state];
        }
    }

    /**
     * Function find card and relation ship the cart
     *
     * @param int $id of cart
     * @return mixed
     */
    public function findCartAndRelationShip($id)
    {
        return Cart::with(['user', 'cartDetail' => function ($query) {
            $query->join('products', 'product_id', 'products.id');
        }])->find($id);
    }

    /**
     * Function search carts using condition param
     *
     * @param array $param
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function search($param)
    {
        $carts = Cart::on();
        if (isset($param['code'])) {
            $carts->where('code', 'like', '%' . $param['code'] . '%');
        }
        if (isset($param['status'])) {
            $carts->where('status', $param['status']);
        }
        if (isset($param['amount'])) {
            $carts->where('amount', $param['amount']);
        }
        if (isset($param['user'])) {
            $carts->join('users', 'user_id', 'id')
                ->where('users.name', 'like', '%' . $param['user'] . '%');
        }
        if (isset($param['state'])) {
            $carts->where('state', $param['state']);
        }
        $carts->join('users', 'cart.user_id', 'users.id')
        ->select(
            'cart.id', 'cart.code', 'cart.amount', 'cart.status', 'cart.state', 'cart.address',
            'users.name', 'users.email'
        )->orderBy('cart.id', 'DESC');

        return $carts->paginate(config('const.paginate'));
    }

    /**
     * Function list all card of the user
     *
     * @param int $userId of user
     * @return mixed
     */
    public function listCartOfUser($userId)
    {
        return Cart::where('user_id', $userId)->orderBy('id', 'DESC')->get();
    }
}
