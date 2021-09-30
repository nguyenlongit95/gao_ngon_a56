<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'info',
        'description',
        'price',
        'origin',
        'code',
        'qa_code',
        'status',
        'qty',
    ];

    /**
     * Collect 1-1 to category table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    /**
     * Collect 1-n to product_img table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImg()
    {
        return $this->hasMany('App\Models\ProductImg', 'product_id', 'id');
    }

    /**
     * Collect 1-n to attitude table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productAttitude()
    {
        return $this->hasMany('App\Models\ProductAttitude', 'product_id', 'id');
    }

    /**
     * Collect 1-n to product tags table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productTags()
    {
        return $this->hasMany('App\Models\ProductTags', 'product_id', 'id');
    }

    /**
     * Collect 1-n to wish list table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishList()
    {
        return $this->hasMany('App\Models\Wishlist', 'product_id', 'id');
    }

    /**
     * Collect 1-n to color table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function color()
    {
        return $this->hasMany('App\Models\ProductColor', 'product_id', 'id');
    }

    /**
     * Collect 1-n to size table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function size()
    {
        return $this->hasMany('App\Models\ProductSize', 'product_id', 'id');
    }
}
