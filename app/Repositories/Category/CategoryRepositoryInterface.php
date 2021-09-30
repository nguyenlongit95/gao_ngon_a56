<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    /**
     * @param object $category an category
     * @return mixed
     */
    public function checkDataDepend($category);
}
