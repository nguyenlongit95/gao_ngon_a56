@extends('admin.master')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('/css/custom/CustomStyle.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit a product</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="col-md-12 float-left">
            @include('admin.layouts.errors')
        </div>

        <div class="col-md-12 float-right">
            <a href="{{ url('/admin/product/') }}" class="float-right">Back to the list page</a>
        </div>

        <!-- /.content-header -->
    <section class="content">
        <div class="col-9 float-left">
            <form role="form" action="{{ url('/admin/product/' . $product->id . '/update') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Information</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Slug <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" readonly id="slug" name="slug" value="{{ $product->slug }}">
                            </div>
                            <div class="form-group">
                                <label for="code">Category<span class="icon-required">*</span></label>
                                <select name="category_id" class="form-control" id="category">
                                    @if(!empty($categories))
                                        @foreach($categories as $value)
                                            <option @if($value->id === $product->category_id) selected @endif value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="info">Information <span class="icon-required">*</span></label>
                                <textarea class="form-control" id="info" name="info">{{ $product->info }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Description <span class="icon-required">*</span></label>
                                <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="col-3 float-right">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Details</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="code">Code of product<span class="icon-required">*</span></label>
                                <input type="text" class="form-control" readonly id="code" name="code" value="{{ $product->code }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Price <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
                            </div>
                            <div class="form-group">
                                <label for="origin">Original <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="origin" name="origin" value="{{ $product->origin }}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status of product<span class="icon-required">*</span></label>
                                <select name="status" class="form-control" id="status">
                                    <option @if($product->status === 0) selected @endif value="0">{{ config('langEN.product.status.out_of_stock') }}</option>
                                    <option @if($product->status === 1) selected @endif value="1">{{ config('langEN.product.status.in_stock') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity <span class="icon-required">*</span></label>
                                <input type="number" class="form-control" id="qty" name="qty" value="{{ $product->qty }}">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="card-footer">
                                <p>- The name field will automatically be translated into the <span class="text-danger">slug</span> field after you finish typing 1 character.</p>
                                <p>- The product <span class="text-danger">code</span> will be encrypted using the <span class="text-danger">MD5 algorithm</span> according to the product name.</p>
                                <a href="{{ url('/admin/product/' . $product->id . '/show') }}" class="btn btn-primary float-right"><i class="fas fa-search"></i> Preview</a>
                                <button type="submit" class="btn btn-primary float-right margin-right-15"><i class="fas fa-pen"></i> Update</button>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>

                <div class="col-3 float-right">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <label for="tags">Tags</label>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <?php $i = 1; ?>
                                @if(!empty($tags))
                                    @foreach($tags as $value)
                                        <input @if(in_array($value->id, $allTags)) checked @endif type="checkbox" @if($i > 1) class="margin-left-15" @endif name="tags[]" id="tags_{{ $value->id }}" value="{{ $value->id }}">
                                        <label for="tags_{{ $value->id }}">{{ $value->tags }}</label>
                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>

                <div class="col-3 float-right">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <label for="tags">Render QR-code</label>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <p class="btn btn-default" id="render_qr_code">Render QR-Code</p>
                                <div class="col-12 text-center" id="qr_code_preview">
                                    {!! $qrCode !!}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>
                </form>

                <div class="col-3 float-left" id="section-attibute-product">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <label for="tags">Product color list</label>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 text-center" id="attribute_preview">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead class="background-blue color-white">
                                            <tr>
                                                <td>Color</td>
                                                <td>Action</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($getColor))
                                                @foreach($getColor as $value)
                                                    <tr>
                                                        <td>
                                                            <div class="row justify-content-center">
                                                                <div class="txt-color">{{ $value->color }}</div>  <div class="box-color-preview ml-3 rounded-circle" style="background: {{ $value->color }};"></div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('/admin/product/color/' . $value->id . '/delete') }}"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <p class="text-center text-danger">This product has not added specific attributes</p>
                                            @endif
                                            <form id="form_add_color_product" action="{{ url('/admin/product/color/' . $product->id . '/add') }}" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <tr>
                                                    <td><input type="color" name="color" class="form-control"></td>
                                                    <td>
                                                        <button class="btn-none-button"><i class="fas fa-plus-circle margin-top-10"></i></button>
                                                    </td>
                                                </tr>
                                            </form>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>

                <div class="col-3 float-left" id="section-attibute-product">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <label for="tags">Product size list</label>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 text-center" id="attribute_preview">
                                        <table class="table table-hover table-bordered text-center">
                                            <thead class="background-blue color-white">
                                            <tr>
                                                <td>Size</td>
                                                <td>Action</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($size))
                                                @foreach($size as $value)
                                                    <tr>
                                                        <td>{{ $value->size }}</td>
                                                        <td>
                                                            <a href="{{ url('/admin/product/size/' . $value->id . '/delete') }}"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <p class="text-center text-danger">This product has not added specific attributes</p>
                                            @endif
                                            <form id="form_add_size_product" action="{{ url('/admin/product/size/' . $product->id . '/add') }}" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <tr>
                                                    <td><input type="text" name="size" class="form-control" placeholder="Size name"></td>
                                                    <td>
                                                        <button class="btn-none-button"><i class="fas fa-plus-circle margin-top-10"></i></button>
                                                    </td>
                                                </tr>
                                            </form>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>

                <div class="col-3 float-left" id="section-attibute-product">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        <label for="tags">Product attibute list</label>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 text-center" id="attribute_preview">
                                <table class="table table-hover table-bordered text-center">
                                    <thead class="background-blue color-white">
                                    <tr>
                                        <td>Attribute</td>
                                        <td>Value</td>
                                        <td>Sort</td>
                                        <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($attributes))
                                        @foreach($attributes as $value)
                                            <tr>
                                                <td>{{ $value->attribute }}</td>
                                                <td>{{ $value->value }}</td>
                                                <td>{{ $value->sort }}</td>
                                                <td>
                                                    <a href="{{ url('/admin/product/attribute/' . $value->id . '/delete') }}"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p class="text-center text-danger">This product has not added specific attributes</p>
                                    @endif
                                    <form id="form_add_attribute_product" action="{{ url('/admin/product/attribute/' . $product->id . '/add') }}" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <tr>
                                            <td><input type="text" name="attribute" class="form-control" placeholder="Attribute name"></td>
                                            <td><input type="text" name="value" class="form-control" placeholder="Valute attribute"></td>
                                            <td><input type="number" name="sort" class="form-control" placeholder="1"></td>
                                            <td>
                                                <button class="btn-none-button"><i class="fas fa-plus-circle margin-top-10"></i></button>
                                            </td>
                                        </tr>
                                    </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
        </div>

                <div class="col-12 float-left" id="section-image-product">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">
                                <label for="tags">Product photo list</label>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="form_add_image_product" action="{{ url('/admin/product/image/' . $product->id . '/add') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <div class="col-12 text-center" id="image_preview">
                                        <div class="row">
                                            @if(!empty($listImage))
                                                @foreach($listImage as $image)
                                                <div class="col-sm-2 box-image-product">
                                                    <a href="{{ url('/admin/product/image/' . $image->id . '/delete') }}"><i class="fas fa-times-circle close"></i></a>
                                                    <img src="{{ asset($image->image) }}" id="btn_image_product" class="img-fluid mb-2 image_product" alt="red sample"/>
                                                </div>
                                                @endforeach
                                            @endif
                                            <div class="col-sm-2">
                                                <input type="file" name="image" class="btn_add_image_product" id="btn_add_image_product">
                                                <label for="btn_add_image_product"><i class="fas fa-plus icon-add-image-product"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>
            </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script>
        /**
         * Render slug of name category
         */
        $(document).ready(function () {
            // render slug of name category
            $('#name').keyup(function (evt) {
                $('#slug').val(changeToSlug($(this).val()));
                $('#code').val(hashMd5($(this).val()));
            });

            $('#render_qr_code').click(function (evt) {
                let codeProduct = $('#code').val();
                $.ajax({
                    url: '{{ url('/admin/product/render-qr-code') }}',
                    type: 'get',
                    data: {
                        codeProduct: codeProduct
                    },
                    success: function (response) {
                        $('#qr_code_preview').html(response);

                    },
                    error: function (err) {
                        $('#qr_code_preview').html('<p class="text-danger">Code errors, please check again!</p>');
                    },
                });
            });

            $('input[type="file"]').change(function(e) {
                $('#form_add_image_product').submit();
            });

            // replace information ckeditor
            CKEDITOR.replace('info');
            CKEDITOR.replace('description', {
                filebrowserBrowseUrl : '{{ asset('/plugins/') }}' + '/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl : '{{ asset('/plugins/') }}' + '/ckfinder/ckfinder.html?type=Images',
                filebrowserFlashBrowseUrl : '{{ asset('/plugins/') }}' + '/ckfinder/ckfinder.html?type=Flash',
                filebrowserUploadUrl : '{{ asset('/plugins/') }}' + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : '{{ asset('/plugins/') }}' + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl : '{{ asset('/plugins/') }}' + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            });
        });
    </script>
@endsection
