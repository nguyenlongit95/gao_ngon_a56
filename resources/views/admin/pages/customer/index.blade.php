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
                        <h1 class="m-0 text-dark">Customers</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">
                    <thead class="background-blue color-white">
                    <th>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Total orders</td>
                        <td class="text-center">Action</td>
                    </th>
                    </thead>
                    <tbody>
                    @if(!empty($customers))
                        @foreach($customers as $value)
                        <tr>
                            <td class="text-center">{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ count($value->carts) }}</td>
                            <td class="text-center"><a href="{{ url('/admin/customer/'.$value->id.'/show') }}"><i class="fas fa-edit"></i></a></td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            {!! $customers->render() !!}
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('') }}"></script>
@endsection
