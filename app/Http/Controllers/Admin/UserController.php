<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Users\UserRepositoryinterface;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @var UserRepositoryinterface
     */
    private $userRepository;
    private $cartRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryinterface $userRepository
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(
        UserRepositoryinterface $userRepository,
        CartRepositoryInterface $cartRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->cartRepository = $cartRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->where('role', '>', 0)->get();

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect('/admin/users/index');
        }

        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->userRepository->find($id);
        if (!$user || empty($user)) {
            return redirect('/admin/users/list');
        }

        $param = $request->all();
        if ($param['role'] == 0) {
            return redirect()->back();
        }
        $tempPassword = Hash::make($param['password']);
        $param['password'] = $tempPassword;

        $update = $this->userRepository->update($param, $id);
        if ($update) {
            return redirect('/admin/users/index');
        }

        return redirect('/admin/users/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return redirect()->back();
        }

        $destroy = $this->userRepository->delete($id);
        if ($destroy) {
            return redirect('/admin/users/index');
        }

        return redirect('/admin/users/index');
    }

    /**
     * Controller function list all customer and relationship
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listCustomer(Request $request)
    {
        $customers = $this->userRepository->listCustomer();

        return view('admin.pages.customer.index', compact('customers'));
    }

    /**
     * Controller function show an customer
     *
     * @param Request $request
     * @param integer $id of user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, $id)
    {
        $customer = $this->userRepository->findCustomer($id);
        $totalProductPurchased = 0;
        if (!empty($customer->carts)) {
            foreach ($customer->carts as $cart) {
                $totalProductPurchased += count($cart->cartDetail);
                $cart->txt_status = $this->cartRepository->replaceStatus($cart);
                $cart->txt_state = $this->cartRepository->replaceState($cart);
            }
        }

        return view('admin.pages.customer.show', compact('customer', 'totalProductPurchased'));
    }
}
