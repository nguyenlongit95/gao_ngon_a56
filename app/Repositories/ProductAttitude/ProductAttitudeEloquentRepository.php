<?php

namespace App\Repositories\ProductAttitude;

use App\Models\ProductAttitude;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\DB;

class ProductAttitudeEloquentRepository extends EloquentRepository implements ProductAttitudeRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return ProductAttitude::class;
    }

    /**
     * SQL function get all attribute of product
     *
     * @param object $product
     * @return mixed
     */
    public function getAttOfProduct($product)
    {
        return ProductAttitude::where('product_id', $product->id)->get();
    }

    /**
     * SQL function delete all attribute of product
     *
     * @param object $product
     * @return mixed
     */
    public function deleteAttributeOfProduct($product)
    {
        return DB::table('product_attitude')->where('product_id', $product->id)->delete();
    }
}
