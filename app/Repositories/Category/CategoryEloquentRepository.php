<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Eloquent\EloquentRepository;

class CategoryEloquentRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Category::class;
    }

    /**
     * Function count the number of products an category
     *
     * @param int $category of category
     * @return mixed
     */
    public function checkDataDepend($category)
    {
        return Product::where('category_id', $category->id)->count();
    }
}
