<?php

namespace App\Providers;

use App\Factory\Paygates\NganLuong\NL_Checkout;
use App\Repositories\Cart\CartEloquentRepository;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\CartDetail\CartDetailEloquentRepository;
use App\Repositories\CartDetail\CartDetailRepositoryInterface;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductEloquentRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductAttitude\ProductAttitudeEloquentRepository;
use App\Repositories\ProductAttitude\ProductAttitudeRepositoryInterface;
use App\Repositories\ProductImg\ProductImgEloquentRepository;
use App\Repositories\ProductImg\ProductImgRepositoryInterface;
use App\Repositories\ProductTags\ProductTagsEloquentRepository;
use App\Repositories\ProductTags\ProductTagsRepositoryInterface;
use App\Repositories\Ratting\RattingEloquentRepository;
use App\Repositories\Ratting\RattingRepositoryInterface;
use App\Repositories\Slider\SliderEloquentRepository;
use App\Repositories\Slider\SliderRepositoryInterface;
use App\Repositories\Tags\TagsEloquentRepository;
use App\Repositories\Tags\TagsRepositoryInterface;
use App\Repositories\Wishlist\WishListEloquentRepository;
use App\Repositories\Wishlist\WishListRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Paygates\PaygateRepositoryInterface::class,
            \App\Repositories\Paygates\PaygateEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Widgets\WidgetRepositoryInterface::class,
            \App\Repositories\Widgets\WidgetEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Users\UserRepositoryinterface::class,
            \App\Repositories\Users\UserEloquentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Menus\MenusRepositoryInterface::class,
            \App\Repositories\Menus\MenusEloquentRepository::class
        );
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryEloquentRepository::class
        );
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductEloquentRepository::class
        );
        $this->app->bind(
            ProductImgRepositoryInterface::class,
            ProductImgEloquentRepository::class
        );
        $this->app->bind(
            ProductAttitudeRepositoryInterface::class,
            ProductAttitudeEloquentRepository::class
        );
        $this->app->bind(
            TagsRepositoryInterface::class,
            TagsEloquentRepository::class
        );
        $this->app->bind(
            ProductTagsRepositoryInterface::class,
            ProductTagsEloquentRepository::class
        );
        $this->app->bind(
            WishListRepositoryInterface::class,
            WishListEloquentRepository::class
        );
        $this->app->bind(
            RattingRepositoryInterface::class,
            RattingEloquentRepository::class
        );
        $this->app->bind(
            CartRepositoryInterface::class,
            CartEloquentRepository::class
        );
        $this->app->bind(
            CartDetailRepositoryInterface::class,
            CartDetailEloquentRepository::class
        );
        $this->app->bind(
            SliderRepositoryInterface::class,
            SliderEloquentRepository::class
        );

        $this->app->bind(
            NL_Checkout::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
