<?php

namespace App\Repositories\ProductImg;

use App\Models\ProductImg;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\Log;

class ProductImgEloquentRepository extends EloquentRepository implements ProductImgRepositoryInterface
{
    const IMAGE_PATH = '/image/products/';
    /**
     * @return mixed
     */
    public function getModel()
    {
        return ProductImg::class;
    }

    /**
     * Function add a image
     *
     * @param object $product
     * @param $request
     * @return mixed
     */
    public function addImage($product, $request)
    {
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
                $fileName = 'image_' . $product->id . "_" . $request->file('image')->getClientOriginalName();
                try {
                    $request->file('image')->move(public_path(self::IMAGE_PATH), $fileName);
                    return [
                        'image' => self::IMAGE_PATH . $fileName
                    ];
                } catch (\Exception $exception) {
                    Log::error($exception);
                    return 2; // Error system
                }
            } else {
                return 1; // Error ext
            }
        } else {
            return 0; // Image not found
        }
    }

    /**
     * Function get all image of product
     *
     * @param object $product
     * @return mixed
     */
    public function getImageOfProduct($product)
    {
        return ProductImg::where('product_id', $product->id)->get();
    }

    /**
     * @param $image
     * @return mixed
     */
    public function removeImage($image)
    {
        if (file_exists(public_path($image->image))) {
            try {
                return unlink(public_path($image->image));
            } catch (\Exception $exception) {
                Log::error($exception);
                return false;
            }
        } else {
            return false;
        }
    }
}
