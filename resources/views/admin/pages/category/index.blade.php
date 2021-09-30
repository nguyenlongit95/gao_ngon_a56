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
                        <h1 class="m-0 text-dark">Categories</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="col-md-12 float-left">
            @include('admin.layouts.errors')
        </div>

        <section class="content">
            <div class="row">
                <div class="col-md-12 float-left margin-bottom-15">
                    <div class="col-md-2 float-right">
                        <a href="{{ url('/admin/category/create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add new</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 float-left">
                <table class="table table-hover table-bordered text-center">
                    <thead class="background-blue color-white">
                    <th>
                        <td>Name</td>
                        <td>Slug</td>
                        <td>Sort</td>
                        <td>Action</td>
                    </th>
                    </thead>
                    <tbody>
                    @if(!empty($categories))
                        @foreach($categories as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->slug }}</td>
                                <td>{{ $value->sort }}</td>
                                <td>
                                    <a href="{{ url('/admin/category/'.$value->id.'/edit') }}"><i class="fas fa-edit"></i></a>
                                    |
                                    <a href="{{ url('/admin/category/'.$value->id.'/delete') }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="col-md-12 pull-right">
                    {!! $categories->render() !!}
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
@endsection
