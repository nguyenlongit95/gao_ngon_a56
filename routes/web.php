<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\WidgetController;
use App\Http\Controllers\Admin\PaygateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/admin'], function () {
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/login', [LoginController::class, 'postLogin']);
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::get('login', [\App\Http\Controllers\FrontEnd\LoginController::class, 'login']);
Route::post('login', [\App\Http\Controllers\FrontEnd\LoginController::class, 'postLogin']);
Route::get('register', [\App\Http\Controllers\FrontEnd\LoginController::class, 'register']);
Route::post('register', [\App\Http\Controllers\FrontEnd\LoginController::class, 'postRegister']);
Route::get('logout', [\App\Http\Controllers\FrontEnd\LoginController::class, 'logout']);
Route::get('forgot-password', [\App\Http\Controllers\FrontEnd\LoginController::class, 'forgotPassword']);
Route::post('forgot-password', [\App\Http\Controllers\FrontEnd\LoginController::class, 'forgotPassword']);

Route::group(['middleware' => 'checkUserLogin'], function () {
    // Route front end has required login
});

Route::group(['prefix' => 'paypal'], function () {
    Route::get('init-payment', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'payPalInitPayment']);
});

Route::group(['prefix' => 'ngan-luong'], function () {
    Route::post('ngan-luong-init-payment', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'nganLuongInitPayment']);
    Route::get('success', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'nganLuongSuccessPayment']);
    Route::get('cancel', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'nganLuongCancelPayment']);
    Route::get('failed', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'nganLuongFailedPayment']);
});

Route::group(['prefix' => 'vn-pay'], function () {
    Route::post('vn-pay-init-payment', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'vnPayInitPayment']);
    Route::get('return', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'vnPayReturn']);
});

Route::group(['prefix' => 'momo'], function () {
    Route::post('momo-init-payment', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'momoInitPayment']);
    Route::get('result', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'momoResult']);
    Route::get('ipn', [\App\Http\Controllers\FrontEnd\PaymentController::class, 'momoIPN']);
});

/**
 * Route admin panel
 * Middelware
 */
Route::group(['middleware' => 'checkAdminLogin', 'prefix' => 'admin'], function () {
    Route::get('/', [DashBoardController::class, 'index']);

    Route::group(['prefix' => 'widgets'], function () {
        Route::get('/index', [WidgetController::class, 'index']);
        Route::post('{id}/update', [WidgetController::class, 'update']);
        Route::get('{id}/delete', [WidgetController::class, 'delete']);
        Route::post('create',[WidgetController::class, 'create']);
    });

    Route::group(['prefix' => 'paygates'], function () {
        Route::get('index', [PaygateController::class, 'index']);
        Route::get('{id}/edit', [PaygateController::class, 'edit']);
        Route::post('{id}/update', [PaygateController::class, 'update']);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('index', [UserController::class, 'index']);
        Route::get('{id}/edit', [UserController::class, 'edit']);
        Route::post('{id}/update', [UserController::class, 'update']);
        Route::get('{id}/delete', [UserController::class, 'delete']);
    });

    Route::group(['prefix' => 'menus'], function () {
        Route::get('index', [MenuController::class, 'index']);
        Route::get('{id}/edit', [MenuController::class, 'edit']);
        Route::post('{id}/update', [MenuController::class, 'update']);
        Route::post('create', [MenuController::class, 'store']);
        Route::get('show/{id}', [MenuController::class, 'show']);
        Route::get('create', [MenuController::class, 'create']);
        Route::get('{id}/delete', [MenuController::class, 'destroy']);
        Route::get('add', [MenuController::class, 'add']);
    });

    /**
     * Admin router for e-commerce
     */
    Route::group(['prefix' => 'qr-code'], function () {
        Route::get('default-qr-code', [\App\Http\Controllers\Admin\ProductController::class, 'defaultQRCode']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index']);
        Route::get('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create']);
        Route::post('/add', [\App\Http\Controllers\Admin\CategoryController::class, 'store']);
        Route::get('{id}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit']);
        Route::post('{id}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'update']);
        Route::get('{id}/delete', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy']);
    });

    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\TagsController::class, 'index']);
        Route::get('/create', [\App\Http\Controllers\Admin\TagsController::class, 'create']);
        Route::post('/add', [\App\Http\Controllers\Admin\TagsController::class, 'store']);
        Route::get('{id}/edit', [\App\Http\Controllers\Admin\TagsController::class, 'edit']);
        Route::post('{id}/update', [\App\Http\Controllers\Admin\TagsController::class, 'update']);
        Route::get('{id}/delete', [\App\Http\Controllers\Admin\TagsController::class, 'destroy']);
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index']);
        Route::get('/create', [\App\Http\Controllers\Admin\ProductController::class, 'create']);
        Route::post('/add', [\App\Http\Controllers\Admin\ProductController::class, 'store']);
        Route::get('{id}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit']);
        Route::post('{id}/update', [\App\Http\Controllers\Admin\ProductController::class, 'update']);
        Route::post('image/{id}/add', [\App\Http\Controllers\Admin\ProductController::class, 'addImage']);
        Route::get('image/{id}/delete', [\App\Http\Controllers\Admin\ProductController::class, 'removeImage']);
        Route::post('/attribute/{id}/add', [\App\Http\Controllers\Admin\ProductController::class, 'addAttribute']);
        Route::get('/attribute/{id}/delete', [\App\Http\Controllers\Admin\ProductController::class, 'removeAttribute']);
        Route::get('/data-dependent', [\App\Http\Controllers\Admin\ProductController::class, 'checkDataDependent']);
        Route::get('/delete', [\App\Http\Controllers\Admin\ProductController::class, 'destroy']);
        Route::get('{id}/show', [\App\Http\Controllers\Admin\ProductController::class, 'show']);
        Route::get('/search', [\App\Http\Controllers\Admin\ProductController::class, 'search']);
        Route::get('render-qr-code', [\App\Http\Controllers\Admin\ProductController::class, 'renderQACode']);
        Route::post('/color/{id}/add', [\App\Http\Controllers\Admin\ProductController::class, 'addColor']);
        Route::get('/color/{id}/delete', [\App\Http\Controllers\Admin\ProductController::class, 'deleteColor']);
        Route::post('/size/{id}/add', [\App\Http\Controllers\Admin\ProductController::class, 'addSize']);
        Route::get('/size/{id}/delete', [\App\Http\Controllers\Admin\ProductController::class, 'deleteSize']);
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CartController::class, 'index']);
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\CartController::class, 'edit']);
        Route::post('/{id}/update', [\App\Http\Controllers\Admin\CartController::class, 'update']);
        Route::get('/search', [\App\Http\Controllers\Admin\CartController::class, 'search']);
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', [UserController::class, 'listCustomer']);
        Route::get('/{id}/show', [UserController::class, 'show']);
    });

    Route::group(['prefix' => 'sliders'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\SliderController::class, 'index']);
        Route::get('/index', [\App\Http\Controllers\Admin\SliderController::class, 'index']);
        Route::get('/add', [\App\Http\Controllers\Admin\SliderController::class, 'create']);
        Route::post('/store', [\App\Http\Controllers\Admin\SliderController::class, 'store']);
        Route::get('{id}/edit', [\App\Http\Controllers\Admin\SliderController::class, 'edit']);
        Route::post('{id}/update', [\App\Http\Controllers\Admin\SliderController::class, 'update']);
        Route::get('{id}/delete', [\App\Http\Controllers\Admin\SliderController::class, 'destroy']);
    });
});
