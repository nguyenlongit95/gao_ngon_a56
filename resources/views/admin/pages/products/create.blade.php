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
                        <h1 class="m-0 text-dark">Create new product</h1>
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
        <form role="form" action="{{ url('/admin/product/add') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section class="content">
                <div class="col-9 float-left">
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
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name of product">
                            </div>
                            <div class="form-group">
                                <label for="name">Slug <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" readonly id="slug" name="slug" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="code">Category<span class="icon-required">*</span></label>
                                <select name="category_id" class="form-control" id="category">
                                    @if(!empty($categories))
                                        @foreach($categories as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="info">Information <span class="icon-required">*</span></label>
                                <textarea class="form-control" id="info" name="info"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Description <span class="icon-required">*</span></label>
                                <textarea class="form-control" id="description" name="description"></textarea>
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
                                <input type="text" class="form-control" readonly id="code" name="code" value="">
                            </div>
                            <div class="form-group">
                                <label for="name">Price <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="origin">Original <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="origin" name="origin" placeholder="VN">
                            </div>
                            <div class="form-group">
                                <label for="status">Status of product<span class="icon-required">*</span></label>
                                <select name="status" class="form-control" id="status">
                                    <option value="0">{{ config('langEN.product.status.out_of_stock') }}</option>
                                    <option value="1">{{ config('langEN.product.status.in_stock') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity <span class="icon-required">*</span></label>
                                <input type="number" class="form-control" id="qty" name="qty" placeholder="1">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="card-footer">
                                <p>- The name field will automatically be translated into the <span class="text-danger">slug</span> field after you finish typing 1 character.</p>
                                <p>- The product <span class="text-danger">code</span> will be encrypted using the <span class="text-danger">MD5 algorithm</span> according to the product name.</p>
                                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Create</button>
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
                                        <input type="checkbox" @if($i > 1) class="margin-left-15" @endif name="tags[]" id="tags_{{ $value->id }}" value="{{ $value->id }}">
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

                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>
            </section>
        </form>
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
