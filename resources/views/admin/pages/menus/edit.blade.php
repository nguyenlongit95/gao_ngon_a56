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
                        <h1 class="m-0 text-dark">Edit Menu</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <form action="{{ url('/admin/menus/'.$menu->id.'/update') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-body" style="display: block;">
                                <div class="form-group">
                                    <label for="inputName">Name</label>
                                    <input type="text" name="name" id="menu-name-update" class="form-control" value="{{ $menu->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" class="form-control" id="menu-slug-update" value="{{ $menu->slug }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputClientCompany">Status</label>
                                    <select name="status" class="form-control">
                                        <option @if($menu->status == 0) selected @endif value="0">UnActive</option>
                                        <option @if($menu->status == 1) selected @endif value="1">Active</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="info">Info</label>
                                    <textarea name="info" class="form-control" rows="4">{{ $menu->info }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="sort">Sort</label>
                                    <input type="text" name="sort" class="form-control" value="{{ $menu->sort }}">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update" class="btn btn-primary float-right" value="Update">
                                </div>

                            </div>
                            <div class="col-12 form-group">
                                <p>Updated parent menu at the top</p>
                                <p>Select the detailed button in the list of submenu below, the menu content will display on the form above. As usual, it will add a new menu</p>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Add new or update sub menu</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" id="show-sub-menu" style="display: block;">
                            @include('admin.pages.menus.create')
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">List sub menu</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Slug</th>
                                    <th>Sort</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                    @if(count($subMenus) > 0)
                                        @foreach($subMenus as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->slug }}</td>
                                                <td>{{ $value->sort }}</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm color-white">
                                                        <a onclick="showSubMenu({{ $value->id }})" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ url('/admin/menus/'.$value->id.'/delete') }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <br>
                            <div class="form-group">
                                <div class="container">
                                    <button id="btn-add-submenu" class="btn btn-primary float-right">Add new</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('/js/pages/menus/menus.js') }}"></script>
@endsection
