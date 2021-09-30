<?php

namespace App\Repositories\ProductTags;

interface ProductTagsRepositoryInterface
{
    /**
     * @param object $product
     * @param array $tags
     * @return mixed
     */
    public function assignProductTags($product, $tags);

    /**
     * @param object $product
     * @return mixed
     */
    public function getTagsOfProduct($product);

    /**
     * @param $product
     * @return mixed
     */
    public function removeProductTags($product);
}
