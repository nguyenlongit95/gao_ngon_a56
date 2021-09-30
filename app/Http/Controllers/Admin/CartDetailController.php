<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartDetail;
use App\Repositories\CartDetail\CartDetailRepositoryInterface;
use App\Support\ResponseHelper;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    private $cartDetailRepository;

    public function __construct(CartDetailRepositoryInterface $cartDetailRepository)
    {
        $this->cartDetailRepository = $cartDetailRepository;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id of detail cart
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(Request $request)
    {
        $param = $request->all(); dd($param);
        $cartDetail = $this->cartDetailRepository->find($param['id']);
        if (!$cartDetail) {
            return redirect()->back()->with('status', config('langEN.find.failed'));
        }

        $update = $this->cartDetailRepository->update($param, $param['id']);
        if (!$update) {
            return app()->make(ResponseHelper::class)->error();
        }

        return app()->make(ResponseHelper::class)->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id of detail cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cartDetail = $this->cartDetailRepository->find($id);
        if (!$cartDetail) {
            return redirect()->back()->with('status', config('langEN.find.failed'));
        }

        $delete = $this->cartDetailRepository->delete($id);
        if (!$delete) {
            return redirect()->back()->with('status', config('langEN.admin.delete.failed'));
        }

        return redirect()->back()->with('status', config('langEN.admin.delete.success'));
    }
}
