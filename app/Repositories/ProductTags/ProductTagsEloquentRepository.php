<?php

namespace App\Repositories\ProductTags;

use App\Models\Product;
use App\Models\ProductTags;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductTagsEloquentRepository extends EloquentRepository implements ProductTagsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return ProductTags::class;
    }

    /**
     * Function assign tags to product
     *
     * @param object $product
     * @param array $tags
     * @return mixed
     */
    public function assignProductTags($product, $tags)
    {
        try {
            if (is_array($tags)) {
                foreach ($tags as $tag) {
                    DB::table('product_tags')->insert([
                        'product_id' => $product->id,
                        'tags_id' => $tag
                    ]);
                }

                return true;
            }
        } catch (\Exception $exception) {
           Log::error($exception);
           return false;
        }
    }

    /**
     * SQL function take all tags for the product
     *
     * @param object $product
     * @return mixed
     */
    public function getTagsOfProduct($product)
    {
        return ProductTags::where('product_id', $product->id)->pluck('tags_id')->toArray();
    }

    /**
     * Delete all product association tags
     *
     * @param object $product
     * @return mixed
     */
    public function removeProductTags($product)
    {
        try {
            return DB::table('product_tags')->where('product_id', $product->id)->delete();
        } catch (\Exception $exception) {
            Log::error($exception);
            return false;
        }
    }
}
