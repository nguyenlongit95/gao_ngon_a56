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
                        <h1 class="m-0 text-dark">Category</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="col-md-12 float-left">
            @include('admin.layouts.errors')
        </div>

        <div class="col-md-12 float-right">
            <a href="{{ url('/admin/category/') }}" class="float-right">Back to the list page</a>
        </div>

        <!-- /.content-header -->
        <form role="form" action="{{ url('/admin/category/' . $category->id . '/edit') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section class="content">
                <div class="col-7 float-left">
                    <div class="card">
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
                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description <span class="icon-required">*</span></label>
                                <textarea class="form-control" id="description" name="description">{!! $category->description !!}</textarea>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="col-5 float-right">
                    <div class="card">
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
                                <label for="name">Slug <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" readonly id="slug" name="slug" value="{{ $category->slug }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Sort <span class="icon-required">*</span></label>
                                <input type="number" class="form-control" id="sort" name="sort" value="{{ $category->sort }}">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="card-footer">
                                <p>- The sort item will be the display order of this category on the displayed page.</p>
                                <p>- The name field will automatically be translated into the slug field after you finish typing 1 character.</p>
                                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-pen"></i> Update</button>
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
            });

            // replace information ckeditor
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
