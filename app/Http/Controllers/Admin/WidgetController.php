<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Widgets\WidgetRepositoryInterface;
use Illuminate\Http\Request;
use DB;

class WidgetController extends Controller
{
    protected $widgetRepository;

    /**
     * WidgetController constructor.
     * @param WidgetRepositoryInterface $widgetRepository
     */
    public function __construct(WidgetRepositoryInterface $widgetRepository)
    {
        $this->widgetRepository = $widgetRepository;
    }

    /**
     * Function get all settings
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $widgets = DB::table('settings')->get();

        return view('admin.pages.widget.index', compact('widgets'));
    }

    /**
     * Function update an record settings
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $param = $request->all();
        $update = $this->widgetRepository->update($param, $id);
        if ($update) {
            return redirect('/admin/widgets/index');
        }

        return redirect('/admin/widgets/index');
    }

    /**
     * Function create a record settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        $param = $request->all();
        $create = $this->widgetRepository->create($param);
        if ($create) {
            return redirect('/admin/widgets/index');
        }

        return redirect('/admin/widgets/index');
    }

    /**
     * Function delete a record settings
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request, $id)
    {
        $widget = $this->widgetRepository->find($id);
        if (!$widget) {
            return redirect('/admin/widgets/index');
        }

        $delete = $this->widgetRepository->delete($id);
        if ($delete) {
            return redirect('/admin/widgets/index');
        }

        return redirect('/admin/widgets/index');
    }
}
