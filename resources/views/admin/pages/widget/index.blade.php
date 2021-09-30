@extends('admin.master')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('/css/CustomStyle.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Widget</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            @if(!empty($widgets))
                @foreach($widgets as $widget)
                    <!-- Began box card -->
                    <div class="col-md-3 float-left">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">{{ $widget->key }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                <form action="{{ url('/admin/widgets/'.$widget->id.'/update') }}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Key <span class="icon-required">*</span></label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="key" value="{{ $widget->key }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Value <span class="icon-required">*</span></label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="value" value="{{ $widget->value }}">
                                    </div>
                                    <a class="float-right btn btn-danger" href="{{ url('/admin/widgets/'.$widget->id.'/delete') }}">Delete </a>
                                    <input type="submit" value="Update" class="float-right btn btn-danger margin-right-5">
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div> <!-- End box card -->
                @endforeach
            @endif
            <div class="col-md-3 float-left">
                <div class="card card-primary card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Add new Widget</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">
                        <form action="{{ url('/admin/widgets/create') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Key <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="key" placeholder="key widget">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Value <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="value" placeholder="value widget">
                            </div>
                            <input type="submit" value="Add new" class="float-right btn btn-warning">
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div> <!-- End box card -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('') }}"></script>
@endsection
