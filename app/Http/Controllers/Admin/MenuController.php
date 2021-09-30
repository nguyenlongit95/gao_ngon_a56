<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Menus\MenusRepositoryInterface;
use App\Support\ResponseHelper;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menuRepository;

    public function __construct(MenusRepositoryInterface $menusRepository)
    {
        $this->menuRepository = $menusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menuRepository->getMasterMenu();

        return view('admin.pages.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function create()
    {
        $menus = $this->menuRepository->getMasterMenu();
        $create = view('admin.pages.menus.create', compact('menus'))->render();

        return app()->make(ResponseHelper::class)->success($create);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->all();
        $store = $this->menuRepository->create($param);
        if ($store) {
            return redirect()->back()->with('status', 'Add an menu success');
        }

        return redirect()->back()->with('status', 'Update menu failed, please check again');
    }

    /**
     * function show submenus
     *
     * @param int $id
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function show($id)
    {
        $menu = $this->menuRepository->find($id);
        if (empty($menu)) {
            return app()->make(ResponseHelper::class)->notFound();
        }
        $render = view('admin.pages.menus.detail', compact('menu'))->render();

        return app()->make(ResponseHelper::class)->success($render);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = $this->menuRepository->find($id);
        if (empty($menu)) {
            return redirect('/admin/menus/index')->with('status', 'Menu not found');
        }
        $subMenus = $this->menuRepository->getSubMenu($id);
        $menus = $this->menuRepository->getMasterMenu();

        return view('admin.pages.menus.edit', compact('menu', 'subMenus', 'menus'));
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
        $menu = $this->menuRepository->find($id);
        if (empty($menu)) {
            return redirect('/admin/menus/'.$id.'/edit')->with('status', 'Cannot find menu');
        }

        $param = $request->all();
        $update = $this->menuRepository->update($param, $id);
        if ($update) {
            return redirect('/admin/menus/'.$id.'/edit')->with('status', 'Update menu success');
        }

        return redirect('/admin/menus/'.$id.'/edit')->with('status', 'Update menu failed, please check again');
    }

    /**
     * function render view add master menu
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        return view('admin.pages.menus.add');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkSubMenu = $this->menuRepository->getSubMenu($id);
        if (!empty($checkSubMenu)) {
            return redirect()->back()->with('status', 'This menu cannot be deleted because of a dependent menu');
        }

        $destroy = $this->menuRepository->delete($id);
        if ($destroy) {
            return redirect()->back()->with('status', 'Delete menu success');
        }

        return redirect()->back()->with('status', 'Delete menu failed, please check again');
    }
}
