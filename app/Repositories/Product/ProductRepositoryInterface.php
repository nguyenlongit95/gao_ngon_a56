<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    /**
     * @param array $param code of product
     * @return mixed
     */
    public function renderQACode($param);

    /**
     * @return mixed
     */
    public function getProducts();

    /**
     * @param array $param
     * @return mixed
     */
    public function searchProduct($param);

    /**
     * @param object $product
     * @return mixed
     */
    public function checkDataDependent($product);

    /**
     * @param $product
     * @return mixed
     */
    public function deleteDataDependent($product);

    /**
     * @param int $id of product
     * @return mixed
     */
    public function showProduct($id);

    /**
     * @param $product
     * @return mixed
     */
    public function getColor($product);

    /**
     * @param $product
     * @param $param
     * @return mixed
     */
    public function addColor($product, $param);

    /**
     * @param int $id of color
     * @return mixed
     */
    public function deleteColor($id);

    /**
     * @param $product
     * @return mixed
     */
    public function getSize($product);

    /**
     * @param $product
     * @param $param
     * @return mixed
     */
    public function addSize($product, $param);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteSize($id);

    /**
     * @param $product
     * @return mixed
     */
    public function getRattingOfProduct($product);
}
