<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductAttitude\ProductAttitudeRepositoryInterface;
use App\Repositories\ProductImg\ProductImgEloquentRepository;
use App\Repositories\ProductTags\ProductTagsRepositoryInterface;
use App\Repositories\Tags\TagsRepositoryInterface;
use App\Support\ResponseHelper;
use App\Support\ResponseQRCode;
use App\Validations\Validation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    private $tagsRepository;
    private $productTagsRepository;
    private $productImgRepository;
    private $productAttributeRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        TagsRepositoryInterface $tagsRepository,
        ProductTagsRepositoryInterface $productTagsRepository,
        ProductImgEloquentRepository $productImgRepository,
        ProductAttitudeRepositoryInterface $productAttributeRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagsRepository = $tagsRepository;
        $this->productTagsRepository = $productTagsRepository;
        $this->productImgRepository = $productImgRepository;
        $this->productAttributeRepository = $productAttributeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->getProducts();
        $categories = $this->categoryRepository->listAll();

        return view('admin.pages.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->listAll();
        $tags = $this->tagsRepository->listAll();

        return view('admin.pages.products.create', compact(
            'categories', 'tags'
        ));
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
        Validation::validationProduct($request);
        $product = $this->productRepository->create($param);
        if (!$product) {
            return redirect()->back()->with('status', config('langEN.create.failed'));
        }

        $assignTags = $this->productTagsRepository->assignProductTags($product, $param['tags']);
        if ($assignTags === false) {
            return redirect('/admin/product/')->with('status', config('langEN.tags.assign_failed'));
        }

        return redirect('/admin/product/')->with('status', config('langEN.create.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @param  int $id of product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $id)
    {
        $product = $this->productRepository->showProduct($id);
        if (!$product) {
            return redirect('/admin/product')->with('status', config('langEN.find.failed'));
        }
        $param['codeProduct'] = $product->code;
        $qrCode = $this->productRepository->renderQACode($param);
        $tags = app()->make(TagsRepositoryInterface::class)->listAll();
        $rattings = $this->productRepository->getRattingOfProduct($product);

        return view('admin.pages.products.show', compact('product', 'qrCode', 'tags', 'rattings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @param  int $id of product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $id)
    {
        $categories = $this->categoryRepository->listAll();
        $tags = $this->tagsRepository->listAll();
        $product = $this->productRepository->find($id);
        if (!$product) {
            return redirect('/admin/product/')->with('status', config('langEN.find.failed'));
        }
        $allTags = $this->productTagsRepository->getTagsOfProduct($product);
        $param['codeProduct'] = $product->code;
        $qrCode = $this->productRepository->renderQACode($param);
        $listImage = $this->productImgRepository->getImageOfProduct($product);
        $attributes = $this->productAttributeRepository->getAttOfProduct($product);
        $getColor = $this->productRepository->getColor($product);
        $size = $this->productRepository->getSize($product);

        return view('admin.pages.products.edit', compact(
            'categories', 'tags', 'product', 'allTags',
            'qrCode', 'listImage', 'attributes', 'getColor', 'size'
        ));
    }

    /**
     * Controller add image an product
     *
     * @param Request $request
     * @param int $id of product
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function addImage(Request $request, $id)
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            return redirect()->back()->with('status', config('langEN.admin.find.failed'));
        }
        $moveImage = $this->productImgRepository->addImage($product, $request);
        if ($moveImage === false) {
            return redirect()->back()->with('status', config('langEN.admin.image.add_failed'));
        }
        $param['image'] = $moveImage['image'];
        $param['product_id'] = $product->id;
        $param['sort'] = 0;

        $createImage = $this->productImgRepository->create($param);
        if (!$createImage) {
            return redirect()->back()->with('status', config('langEN.admin.image.add_failed'));
        }

        return redirect()->back()->with('status', config('langEN.admin.image.add_success'));
    }

    /**
     * Controller remove image of product
     *
     * @param Request $request
     * @param int $id of image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Request $request, $id)
    {
        $image = $this->productImgRepository->find($id);
        if (!$image) {
            return redirect()->back()->with('status', config('langEN.admin.find.failed'));
        }

        $removeImage = $this->productImgRepository->removeImage($image);
        if ($removeImage === false) {
            return redirect()->back()->with('status', config('langEN.admin.image.delete_failed'));
        }

        $delete = $this->productImgRepository->delete($image->id);
        if (!$delete) {
            return redirect()->back()->with('status', config('langEN.admin.image.delete_failed'));
        }

        return redirect()->back()->with('status', config('langEN.admin.image.delete_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id of product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            return redirect()->back()->with('status', config('langEN.find.failed'));
        }
        $param = $request->all();
        Validation::validationProduct($request);
        $update = $this->productRepository->update($param, $id);
        if (!$update) {
            return redirect()->back()->with('status', config('langEN.update.failed'));
        }
        // remove all tags of product
        $this->productTagsRepository->removeProductTags($product);
        // Assign again tags for product
        $assignTags = $this->productTagsRepository->assignProductTags($product, $param['tags']);
        if ($assignTags === false) {
            return redirect('/admin/product/' . $id . '/edit')->with('status', config('langEN.tags.assign_failed'));
        }

        return redirect('/admin/product/' . $id . '/edit')->with('status', config('langEN.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $param = $request->all();
        $product = $this->productRepository->find($param['id']);
        if (!$product) {
            return redirect()->back()->with('status', config('langEN.find.failed'));
        }
        // Check Data
        $checkData = $this->productRepository->checkDataDependent($product);
        if ($checkData) {
            // Not data dependent and destroy now
            $delete = $this->productRepository->delete($product->id);
            if (!$delete) {
                return app()->make(ResponseHelper::class)->error();
            } else {
                return app()->make(ResponseHelper::class)->success();
            }
        } else {
            // Delete data dependent here image, tags, attribute
            $deleteDependentData = $this->productRepository->deleteDataDependent($product);
            if ($deleteDependentData === false) {
                return app()->make(ResponseHelper::class)->error();
            }
            // Not data dependent and destroy now
            $delete = $this->productRepository->delete($product->id);
            if (!$delete) {
                return app()->make(ResponseHelper::class)->error();
            } else {
                return app()->make(ResponseHelper::class)->success();
            }
        }
    }

    /**
     * Controller check data dependent of product
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function checkDataDependent(Request $request)
    {
        $param = $request->all();
        $product = $this->productRepository->find($param['id']);
        if (!$product) {
            return redirect()->back()->with('status', config('langEN.find.failed'));
        }
        $checkData = $this->productRepository->checkDataDependent($product);
        if ($checkData) {
            return app()->make(ResponseHelper::class)->success();
        }

        return app()->make(ResponseHelper::class)->error();
    }

    /**
     * Controller add new attribute of product
     *
     * @param Request $request
     * @param int $id of product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addAttribute(Request $request, $id)
    {
        Validation::validationAttribute($request);
        $param = $request->all();
        $param['product_id'] = $id;
        $create = $this->productAttributeRepository->create($param);
        if (!$create) {
            return redirect()->back()->with('status', config('langEN.admin.attribute.add_failed'));
        }

        return redirect()->back()->with('status', config('langEN.admin.attribute.add_success'));
    }

    /**
     * Controller remove attribute of product
     *
     * @param Request $request
     * @param int $id of attribute
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeAttribute(Request $request, $id)
    {
        $attribute = $this->productAttributeRepository->find($id);
        if (!$attribute) {
            return redirect('/admin/product/')->with('status', config('langEN.find.failed'));
        }

        $delete = $this->productAttributeRepository->delete($attribute->id);
        if (!$delete) {
            return redirect()->back()->with('status', config('langEN.admin.attribute.delete_failed'));
        }

        return redirect()->back()->with('status', config('langEN.admin.attribute.delete_success'));
    }

    /**
     * Controller add new an color of product
     *
     * @param Request $request
     * @param int $id of product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addColor(Request $request, $id)
    {
        $param = $request->all();
        $product = $this->productRepository->find($id);
        $addColor = $this->productRepository->addColor($product, $param);
        if ($addColor) {
            return redirect()->back()->with('status', config('langEN.admin.create.success'));
        }

        return redirect()->back()->with('status', config('langEN.admin.create.failed'));
    }

    /**
     * Controller function delete color of product using id of color
     *
     * @param Request $request
     * @param int $id of color
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteColor(Request $request, $id)
    {
        $this->productRepository->deleteColor($id);
        return redirect()->back();
    }

    /**
     * Controller function add size of product
     *
     * @param Request $request
     * @param int $id of product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSize(Request $request, $id)
    {
        $param = $request->all();
        $product = $this->productRepository->find($id);
        $addSize = $this->productRepository->addSize($product, $param);
        if ($addSize) {
            return redirect()->back()->with('status', config('langEN.admin.create.success'));
        }

        return redirect()->back()->with('status', config('langEN.admin.create.failed'));
    }

    /**
     * Controller function delete size of product using id of color
     *
     * @param Request $request
     * @param int $id of size
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSize(Request $request, $id)
    {
        $this->productRepository->deleteSize($id);
        return redirect()->back();
    }

    /**
     * Controller search product
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $param = $request->all();
        $products = $this->productRepository->searchProduct($param);
        $categories = $this->categoryRepository->listAll();

        return view('admin.pages.products.index', compact('products', 'categories', 'param'));
    }

    /**
     * Controller render QR code an product
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function renderQACode(Request $request)
    {
        $param = $request->all();
        if (!isset($param['codeProduct']) || $param['codeProduct'] == null) {
            return app()->make(ResponseHelper::class)->error(config('langEN.find.failed'));
        }

        return $this->productRepository->renderQACode($param);
    }

    /**
     * Function controller render default qr-code
     *
     * @param Request $request
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function defaultQRCode(Request $request)
    {
        $key = Carbon::now()->format('Y-m-d h:i:s');

        $renderCode = app()->make(ResponseQRCode::class)->defaultQRCode($key, md5('lorem'));
        // TODO insert code to Database by render utf-8
//        $codeAsUTF8 = app()->make(ResponseQRCode::class)->encodedAsUTF8($key, md5('lorem'));

//        $encodeIsColor = app()->make(ResponseQRCode::class)->encodeIsColored($key, md5('lorem'), 'white');

//        $endCodeWithImage = app()->make(ResponseQRCode::class)->encodeWithImage($key, md5('lorem'), asset('image/logoDep.jpg'));

//        $endCodeWithSMS = app()->make(ResponseQRCode::class)->encodeWithSMS($key, md5('lorem'), '0393803548', 'Hello world');

//        $endCodeWithEmail = app()->make(ResponseQRCode::class)->encodeWithSMS('nguyenlongit95@gmail.com', 'Demo Test', 'Hello world!');

        return $renderCode;
    }
}
