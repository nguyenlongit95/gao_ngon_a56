<?php

namespace App\Repositories\Menus;

use App\Models\Menus;
use App\Repositories\Eloquent\EloquentRepository;
use DB;

class MenusEloquentRepository extends EloquentRepository implements MenusRepositoryInterface
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return Menus::class;
    }

    /**
     * function get submenu
     *
     * @param int $id
     * @return mixed
     */
    public function getSubMenu($id)
    {
        $menus = DB::table('menus')->where('parent_id', $id)->orderBy('sort', 'ASC')->get();
        if (empty($menus)) {
            return null;
        }

        return $menus;
    }

    public function getMasterMenu()
    {
        $menus = DB::table('menus')->where('parent_id', 0)->orderBy('sort', 'ASC')->get();
        if (empty($menus)) {
            return null;
        }

        return $menus;
    }
}
