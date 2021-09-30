<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getListCart();

    /**
     * @param $id
     * @return mixed
     */
    public function findCartAndRelationShip($id);

    /**
     * @param $cart
     * @return mixed
     */
    public function addOnAttribute($cart);

    /**
     * @param $cart
     * @return mixed
     */
    public function replaceStatus($cart);

    /**
     * @param $cart
     * @return mixed
     */
    public function replaceState($cart);

    /**
     * @param array $param
     * @return mixed
     */
    public function search($param);

    /**
     * @param $userId
     * @return mixed
     */
    public function listCartOfUser($userId);
}
