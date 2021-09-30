<?php

namespace App\Repositories\ProductImg;

interface ProductImgRepositoryInterface
{
    /**
     * @param $product
     * @param $request
     * @return mixed
     */
    public function addImage($product, $request);

    /**
     * @param $product
     * @return mixed
     */
    public function getImageOfProduct($product);

    /**
     * @param $image
     * @return mixed
     */
    public function removeImage($image);
}
