<?php

namespace App\Repositories\Menus;

interface MenusRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getMasterMenu();
    /**
     * @param $id
     * @return mixed
     */
    public function getSubMenu($id);
}
