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
                        <h1 class="m-0 text-dark">Edit a slider</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="col-md-12 float-left">
            @include('admin.layouts.errors')
        </div>

        <!-- /.content-header -->
        <form role="form" action="{{ url('/admin/sliders/' . $slider->id . '/update') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section class="content">
                <div class="col-7 float-left">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Information</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name (title of slider)<span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $slider->name }}">
                            </div>
                            <div class="form-group">
                                <label for="info">Info <span class="icon-required">*</span></label>
                                <textarea name="info" class="form-control" id="info" cols="30" rows="10">{!! $slider->info !!}</textarea>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="card-footer">
                                </div>
                            </div>
                            <!-- /.card-footer-->
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
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="slogan">Slogan <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="slogan" name="slogan" value="{{ $slider->slogan }}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status <span class="icon-required">*</span></label>
                                <select name="status" id="status" class="form-control">
                                    <option @if($slider->status === 0) selected @endif value="0">InActive</option>
                                    <option @if($slider->status === 1) selected @endif value="1">Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sort">Sort <span class="icon-required">*</span></label>
                                <input type="number" class="form-control" id="sort" name="sort" value="{{ $slider->sort }}">
                            </div>
                            <div class="form-group">
                                <label for="image">Image <span class="icon-required">*</span></label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <p>- The sort item will be the display order of this category on the displayed page <span class="text-danger">*</span></p>
                                <p>- Please select a picture before clicking the create button <span class="text-danger">*</span></p>
                                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-pen"></i> Update</button>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </div>
                </div>
                <div class="col-12 float-left">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Preview slider</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <img id="preview-image-slider" src="{{ asset('/image/sliders/' . $slider->image ) }}" alt="">
                        </div>
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
            // replace information ckeditor
            CKEDITOR.replace('info');
        });
    </script>
@endsection
