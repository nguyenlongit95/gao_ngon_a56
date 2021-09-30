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
                        <h1 class="m-0 text-dark">Add master Menu</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
        <div class="col-12">
            <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Master menu</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <form action="{{ url('/admin/menus/create') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="level" value="2">
                            <input type="hidden" name="count_child" value="0">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="sub-menu-name-create" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" class="form-control" id="sub-menu-slug-update" value="">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Status</label>
                                <select name="status" class="form-control" id="menu-status">
                                    <option value="0">UnActive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="info">Info</label>
                                <textarea id="inputDescription" name="info" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="sort">Sort</label>
                                <input type="text" name="sort" id="inputProjectLeader" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Parent menu</label>
                                <select name="parent_id" class="form-control" id="parent-menu">
                                    @if(!empty($menus))
                                        @foreach($menus as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="Add new" class="btn btn-warning float-right" value="Add new">
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
        </div>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('/js/pages/menus/menus.js') }}"></script>
@endsection
