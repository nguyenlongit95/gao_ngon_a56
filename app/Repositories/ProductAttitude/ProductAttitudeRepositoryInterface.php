<?php

namespace App\Repositories\ProductAttitude;

interface ProductAttitudeRepositoryInterface
{
    /**
     * @param $product
     * @return mixed
     */
    public function getAttOfProduct($product);

    /**
     * @param $product
     * @return mixed
     */
    public function deleteAttributeOfProduct($product);
}
