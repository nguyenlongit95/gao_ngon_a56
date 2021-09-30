<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->getAll(config('const.paginate'), 'DESC');

        return view('admin.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validation::validationCategory($request);
        $param = $request->all();
        $create = $this->categoryRepository->create($param);
        if (!$create) {
            return redirect()->back('status', config('langEN.admin.create.failed'));
        }

        return redirect('/admin/category/')->with('status', config('langEN.admin.create.success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $request
     * @param int $id of category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            return redirect('/admin/category/')->with('status', config('langEN.admin.find.failed'));
        }

        return view('admin.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id of category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validation::validationCategory($request);
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            return redirect('/admin/category/')->with('status', config('langEN.admin.find.failed'));
        }
        $param = $request->all();
        $update = $this->categoryRepository->update($param, $category->id);
        if (!$update) {
            return redirect('/admin/category/' . $id . '/edit')->with('status', config('langEN.admin.update.failed'));
        }

        return redirect('/admin/category/' . $id . '/edit')->with('status', config('langEN.admin.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id id of category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = $this->categoryRepository->find($id);
        if (!$category) {
            return redirect('/admin/category/')->with('status', config('langEN.admin.find.failed'));
        }
        $checkData = $this->categoryRepository->checkDataDepend($category);
        if ($checkData > 0) {
            return redirect('/admin/category/')->with('status', config('langEN.admin.delete.dependent'));
        }
        $delete = $this->categoryRepository->delete($category->id);
        if (!$delete) {
            return redirect('/admin/category/')->with('status', config('langEN.admin.delete.failed'));
        }

        return redirect('/admin/category/')->with('status', config('langEN.admin.delete.success'));
    }
}
