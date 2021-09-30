<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Slider\SliderRepositoryInterface;
use App\Support\FileHelper;
use App\Validations\Validation;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * @var SliderRepositoryInterface
     */
    private $sliderRepository;

    /**
     * SliderController constructor.
     * @param SliderRepositoryInterface $sliderRepository
     */
    public function __construct(SliderRepositoryInterface $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    /**
     * Controller function render view list all slider
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $sliders = $this->sliderRepository->listAll();
        if (!empty($sliders)) {
            foreach ($sliders as $slider) {
                $slider->txt_status = $this->sliderRepository->compareStatus($slider);
            }
        }

        return view('admin.pages.slider.index', compact('sliders'));
    }

    /**
     * Controller function render view add an slider
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('admin.pages.slider.create');
    }

    /**
     * Controller function store an slider and save image to public storage
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(Request $request)
    {
        Validation::validationSlider($request);

        $param = $request->all();
        $addImage = app()->make(FileHelper::class)->addImageSlider($request);
        if ($addImage === 0) {
            return redirect('/admin/sliders/create')->with('status', 'The file format is not correct!');
        }
        if ($addImage === 9) {
            return redirect('/admin/sliders/create')->with('status', 'There is a system error, please try again later.');
        }
        if (is_null($addImage)) {
            return redirect('/admin/sliders/create')->with('status', config('langEN.admin.sliders.image_required'));
        }

        $param['image'] = $addImage;
        $create = $this->sliderRepository->create($param);
        if (!$create) {
            return redirect('/admin/sliders/create')->with('status', 'There is a system error, please try again later.');
        }

        return redirect('/admin/sliders/')->with('status', 'Add item success');
    }

    /**
     * Controller function render view edit an slider
     *
     * @param Request $request
     * @param int $id of slider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Request $request, $id)
    {
        $slider = $this->sliderRepository->find($id);
        if (!$slider) {
            return redirect('/admin/sliders/index')->with('status', config('langEN.admin.find.failed'));
        }

        return view('admin.pages.slider.edit', compact('slider'));
    }

    /**
     * Controller function update an sliders and check file image
     *
     * @param Request $request
     * @param int $id of slider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(Request $request, $id)
    {
        Validation::validationSlider($request);
        $param = $request->all();
        if ($request->hasFile('image')) {
            $addImage = app()->make(FileHelper::class)->addImageSlider($request);
            if ($addImage === 0) {
                return redirect('/admin/sliders/create')->with('status', 'The file format is not correct!');
            }
            if ($addImage === 9) {
                return redirect('/admin/sliders/create')->with('status', 'There is a system error, please try again later.');
            }
            $param['image'] = $addImage;
        }

        $create = $this->sliderRepository->update($param, $id);
        if (!$create) {
            return redirect('/admin/sliders/create')->with('status', 'There is a system error, please try again later.');
        }

        return redirect('/admin/sliders/')->with('status', 'Update item success');
    }

    public function destroy(Request $request, $id)
    {
        $slider = $this->sliderRepository->find($id);
        if (!$slider) {
            return redirect('/admin/sliders/index')->with('status', config('langEN.admin.find.failed'));
        }

        $image = $slider->image;
        if (!$this->sliderRepository->delete($id)) {
            return redirect('/admin/sliders/index')->with('status', 'Delete failed, please check again');
        }
        app()->make(FileHelper::class)->removeImageSlider($image);

        return redirect('/admin/sliders/index')->with('status', 'Delete success');
    }
}
