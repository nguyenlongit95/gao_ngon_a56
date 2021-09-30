<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductAttitude;
use App\Models\ProductImg;
use App\Models\ProductSize;
use App\Models\ProductTags;
use App\Models\Ratting;
use App\Repositories\Eloquent\EloquentRepository;
use App\Repositories\ProductAttitude\ProductAttitudeRepositoryInterface;
use App\Repositories\ProductImg\ProductImgRepositoryInterface;
use App\Repositories\ProductTags\ProductTagsRepositoryInterface;
use App\Support\ResponseQRCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductEloquentRepository extends EloquentRepository implements ProductRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Product::class;
    }

    /**
     * Function render qr-code of product
     *
     * @param array $param code of product
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function renderQACode($param)
    {
        return app()->make(ResponseQRCode::class)->defaultQRCode(random_int(0,9999), $param['codeProduct']);
    }

    /**
     * SQL Function get all product
     *
     * @return mixed
     */
    public function getProducts()
    {
        return Product::with('category')->orderBy('id', 'DESC')
            ->paginate(config('const.paginate'));
    }

    /**
     * Function search product using condition in array param
     *
     * @param array $param condition search
     * @return mixed
     */
    public function searchProduct($param)
    {
        $products = Product::on();
        if (isset($param['name']) && $param['name'] !== null) {
            $products->where('name', 'like', '%' . $param['name'] . '%');
        }
        if (isset($param['category_id'])) {
            $products->where('category_id', $param['category_id']);
        }
        if (isset($param['price'])) {
            $products->where('price', $param['price']);
        }
        if (isset($param['code'])) {
            $products->where('code', $param['code']);
        }
        if (isset($param['status'])) {
            $products->where('status', $param['status']);
        }
        if (isset($param['qty'])) {
            $products->where('qty', $param['qty']);
        }

        return $products->with('category')->orderBy('id', 'DESC')
            ->paginate(config('const.paginate'));
    }

    /**
     * SQL function check for dependent data with this product
     *
     * @param object $product
     * @return bool
     */
    public function checkDataDependent($product)
    {
        // image
        $image = ProductImg::where('product_id', $product->id)->count();
        // attribute
        $attribute = ProductAttitude::where('product_id', $product->id)->count();
        // tags
        $tags = ProductTags::where('product_id', $product->id)->count();
        if ($image > 0 || $attribute > 0 || $tags > 0) {
            return false;
        }

        return true;
    }

    /**
     * Function delete all data dependent with this product
     *
     * @param object $product
     * @return mixed
     */
    public function deleteDataDependent($product)
    {
        try {
            // delete image
            $listImage = app()->make(ProductImgRepositoryInterface::class)->getImageOfProduct($product);
            if (!empty($listImage)) {
                foreach ($listImage as $image) {
                    app()->make(ProductImgRepositoryInterface::class)->removeImage($image);
                }
            }
            // delete attribute
            app()->make(ProductAttitudeRepositoryInterface::class)->deleteAttributeOfProduct($product);
            // delete tags
            app()->make(ProductTagsRepositoryInterface::class)->removeProductTags($product);
            // delete color
            $listColor = $this->getColor($product);
            if (!empty($listColor)) {
                foreach ($listColor as $color) {
                    $this->deleteColor($color->id);
                }
            }
            // delete size
            $listSize = $this->getSize($product);
            if (!empty($listSize)) {
                foreach ($listSize as $size) {
                    $this->deleteSize($size->id);
                }
            }

            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            return false;
        }
    }

    /**
     * SQL function find an product and relationship
     *
     * @param int $id of product
     * @return mixed
     */
    public function showProduct($id)
    {
        return Product::where('id', $id)->with([
            'productImg', 'productAttitude', 'productTags', 'color', 'size', 'category'
        ])->first();
    }

    /**
     * SQL function get color of product
     *
     * @param object $product
     * @return mixed
     */
    public function getColor($product)
    {
        return DB::table('product_color')->where('product_id', $product->id)
            ->orderBy('id', 'ASC')->get();
    }

    /**
     * SQL function insert to table product_color
     *
     * @param object $product
     * @param array $param
     * @return mixed
     */
    public function addColor($product, $param)
    {
        return DB::table('product_color')->insert([
            'product_id' => $product->id,
            'color' => $param['color'],
        ]);
    }

    /**
     * SQL function delete color of product
     *
     * @param int $id of color
     * @return mixed
     */
    public function deleteColor($id)
    {
        return DB::table('product_color')->where('id', $id)->delete();
    }

    /**
     * SQL function add size product
     *
     * @param object $product
     * @param array $param
     * @return mixed
     */
    public function addSize($product, $param)
    {
        return DB::table('product_size')->insert([
            'product_id' => $product->id,
            'size' => $param['size']
        ]);
    }

    /**
     * SQL function delete an size product
     *
     * @param int $id of size
     * @return mixed
     */
    public function deleteSize($id)
    {
        return DB::table('product_size')->where('id', $id)->delete();
    }

    /**
     * SQL function select all size an product
     *
     * @param object $product
     * @return mixed
     */
    public function getSize($product)
    {
        return ProductSize::where('product_id', $product->id)->orderBy('id', 'ASC')->get();
    }

    /**
     * SQL function product ratting of product
     *
     * @param object $product
     * @return mixed
     */
    public function getRattingOfProduct($product)
    {
        return Ratting::join('users', 'users.id', 'rattings.id')->where('product_id', $product->id)
            ->orderBy('rattings.id', 'DESC')->select(
                'users.name', 'users.email', 'rattings.rattings', 'rattings.created_at', 'rattings.id'
            )->get();
    }
}
