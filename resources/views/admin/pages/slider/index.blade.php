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
                        <h1 class="m-0 text-dark">List sliders</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6 float-right text-right">
                        <a href="{{ url('/admin/sliders/add') }}" class="btn btn-primary color-white"><i class="fa fa-plus"></i> Add slider</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="col-md-12 float-left">
            @include('admin.layouts.errors')
        </div>

        <section class="content">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">
                    <thead class="background-blue color-white">
                    <th>
                        <td>Name</td>
                        <td>Slogan</td>
                        <td class="text-center">Image</td>
                        <td class="text-center">Status</td>
                        <td class="text-center">Sort</td>
                        <td class="text-center">Action</td>
                    </th>
                    </thead>
                    <tbody>
                    @if(!empty($sliders))
                        @foreach($sliders as $value)
                            <tr>
                                <td class="text-center">{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->slogan }}</td>
                                <td class="text-center"><img src="{{ asset('/image/sliders/' . $value->image) }}" class="slider-list-page" alt=""></td>
                                <td class="text-center">{{ $value->txt_status }}</td>
                                <td class="text-center">{{ $value->sort }}</td>
                                <td class="text-center">
                                    <a href="{{ url('/admin/sliders/'.$value->id.'/edit') }}"><i class="fas fa-edit"></i></a>
                                    |
                                    <a href="{{ url('/admin/sliders/'.$value->id.'/delete') }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('') }}"></script>
    <style>
        .slider-list-page {
            height: 50px;
            width: 50px;
        }
    </style>
@endsection
