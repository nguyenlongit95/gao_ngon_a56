<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\CartDetail\CartDetailRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Users\UserRepositoryinterface;
use App\Support\ResponseQRCode;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @var CartRepositoryInterface
     * @var CartDetailRepositoryInterface
     */
    private $cartRepository;
    private $cartDetailRepository;
    private $userRepository;
    private $productRepository;

    /**
     * CartController constructor.
     *
     * @param CartRepositoryInterface $cartRepository
     * @param CartDetailRepositoryInterface $cartDetailRepository
     * @param UserRepositoryinterface $userRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        CartDetailRepositoryInterface $cartDetailRepository,
        UserRepositoryinterface $userRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->cartDetailRepository = $cartDetailRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = $this->cartRepository->getListCart();
        $carts = $this->cartRepository->addOnAttribute($carts);

        return view('admin.pages.carts.index', compact('carts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id of order
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function edit(Request $request, $id)
    {
        $cart = $this->cartRepository->findCartAndRelationShip($id);
        if (!$cart) {
            return redirect('/admin/cart')->with('status', config('langEN.find.failed'));
        }
        // Render QR code using shopping cart code and shopping cart id
        $qrCode = app()->make(ResponseQRCode::class)->encodedAsUTF8($cart->id, $cart->code);

        return view('admin.pages.carts.edit', compact('cart', 'qrCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id of order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = $this->cartRepository->find($id);
        if (!$cart) {
            return redirect()->back()->with('status', config('langEN.find.failed'));
        }

        $param = $request->all();
        $update = $this->cartRepository->update($param, $id);
        if (!$update) {
            return redirect('/admin/cart/' . $id. '/edit')->with('status', config('langEN.admin.update.failed'));
        }

        return redirect('/admin/cart/' . $id. '/edit')->with('status', config('langEN.admin.update.success'));
    }

    /**
     * Controller search cart
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $param = $request->all();
        $carts = $this->cartRepository->search($param);
        $carts = $this->cartRepository->addOnAttribute($carts);

        return view('admin.pages.carts.index', compact('carts', 'param'));
    }
}
