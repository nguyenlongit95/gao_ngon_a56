<?php


namespace App\Repositories\Users;


interface UserRepositoryinterface
{
    /**
     * @return mixed
     */
    public function listCustomer();

    /**
     * @param $id
     * @return mixed
     */
    public function findCustomer($id);
}
