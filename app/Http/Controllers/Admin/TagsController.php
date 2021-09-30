<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use App\Repositories\ProductTags\ProductTagsRepositoryInterface;
use App\Repositories\Tags\TagsRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;
use MicrosoftAzure\Storage\Common\Internal\Validate;

class TagsController extends Controller
{
    private $tagsRepository;

    public function __construct(TagsRepositoryInterface $tagsRepository)
    {
        $this->tagsRepository = $tagsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tagsRepository->getAll(config('const.paginate'), 'DESC');
        return view('admin.pages.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validation::validationTags($request);
        $param = $request->all();
        $create = $this->tagsRepository->create($param);
        if (!$create) {
            return redirect()->back()->with('status', config('langEN.create.failed'));
        }

        return redirect('/admin/tags/')->with('status', config('langEN.create.success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id of tags
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $tags = $this->tagsRepository->find($id);
        if (!$tags) {
            return redirect('/admin/tags/')->with('status', config('langEN.find_err'));
        }

        return view('admin.pages.tags.edit', compact('tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id of tags
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tags = $this->tagsRepository->find($id);
        if (!$tags) {
            return redirect('/admin/tags/')->with('status', config('langEN.find_err'));
        }
        Validation::validationTags($request);
        $param = $request->all();
        $update = $this->tagsRepository->update($param, $id);
        if (!$update) {
            return redirect('/admin/tags/' . $tags->id . '/edit')->with('status', config('langEN.update.failed'));
        }

        return redirect('/admin/tags/')->with('status', config('langEN.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id of tags
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $tags = $this->tagsRepository->find($id);
        if (!$tags) {
            return redirect('/admin/tags/')->with('status', config('langEN.find_err'));
        }
        $checkData = $this->tagsRepository->checkDataDepend($tags);
        if ($checkData > 0) {
            return redirect('/admin/tags/')->with('status', config('langEN.delete.dependent'));
        }
        $delete = $this->tagsRepository->delete($tags->id);
        if (!$delete) {
            return redirect('/admin/tags/')->with('status', config('langEN.delete.failed'));
        }

        return redirect('/admin/tags/')->with('status', config('langEN.delete.success'));
    }
}
