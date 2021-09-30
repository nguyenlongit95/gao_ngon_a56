<?php

namespace App\Validations;

class Validation
{
    /**
     * Validate function category
     *
     * @param $request
     */
    public static function validationCategory($request)
    {
        $request->validate([
            'name' => 'required',
            'sort' => 'required',
        ], [
            'name.require' => config('langEN.admin.category.name_required'),
            'sort.require' => config('langEN.admin.category.sort_required'),
        ]);
    }

    /**
     * Validate function tags
     *
     * @param $request
     */
    public static function validationTags($request)
    {
        $request->validate([
            'tags' => 'required',
            'sort' => 'required',
        ], [
            'tags.require' => config('langEN.admin.tags.name_required'),
            'sort.require' => config('langEN.admin.tags.sort_required'),
        ]);
    }

    /**
     * Validate function Product
     *
     * @param $request
     */
    public static function validationProduct($request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'status' => 'required',
            'qty' => 'required|numeric',
        ], [
            'name.require' => config('langEN.admin.product.name_required'),
            'name.min' => config('langEN.admin.product.name_min'),
            'slug.required' => config('langEN.admin.product.slug_required'),
            'category_id.required' => config('langEN.admin.product.category_id_required'),
            'price.required' => config('langEN.admin.product.price_required'),
            'status.required' => config('langEN.admin.product.status_required'),
            'qty.required' => config('langEN.admin.product.qty_required'),
            'qty.numeric' => config('langEN.admin.product.qty_numeric'),
        ]);
    }

    /**
     * Validate attribute of product
     *
     * @param $request
     */
    public static function validationAttribute($request)
    {
        $request->validate([
            'attribute' => 'required',
            'value' => 'required',
            'sort' => 'required|numeric',
        ], [
            'attribute.require' => config('langEN.admin.attribute.attribute_required'),
            'value.require' => config('langEN.admin.attribute.value_required'),
            'sort.require' => config('langEN.admin.attribute.sort_required'),
            'sort.numeric' => config('langEN.admin.attribute.sort_numeric'),
        ]);
    }

    public static function validationSlider($request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slogan' => 'required|max:255',
            'info' => 'required',
            'status' => 'required',
            'sort' => 'required|numeric'
        ], [
            'name.required' => config('langEN.admin.sliders.name_required'),
            'name.max' => config('langEN.admin.sliders.name_max'),
            'slogan.required' => config('langEN.admin.sliders.slogan_required'),
            'slogan.max' => config('langEN.admin.sliders.slogan_max'),
            'info.required' => config('langEN.admin.sliders.info_required'),
            'status.required' => config('langEN.admin.sliders.status_required'),
            'sort.required' => config('langEN.admin.sliders.sort_required'),
            'sort.numeric' => config('langEN.admin.sliders.sort_numeric'),
        ]);
    }
}
