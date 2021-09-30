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
                        <h1 class="m-0 text-dark">List orders</h1>
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
                    <div class="card">
                    <!-- search form -->
                    <form action="{{ url('/admin/cart/search') }}" method="get" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="card-body">
                            <div class="col-md-4 float-left border-right-form-search">
                                <div class="form-group">
                                    <label for="code">Card code</label>
                                    <input type="text" name="code" class="form-control" id="code" value="@if(isset($param['code'])){{ $param['code'] }} @endif">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option @if(isset($param['code']) && $param['status'] == 0) selected @endif value="0">{{ config('const.orders_status')[0] }}</option>
                                        <option @if(isset($param['code']) && $param['status'] == 1) selected @endif value="1">{{ config('const.orders_status')[1] }}</option>
                                        <option @if(isset($param['code']) && $param['status'] == 2) selected @endif value="2">{{ config('const.orders_status')[2] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 float-left border-right-form-search">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" class="form-control" id="amount" value="@if(isset($param['amount'])){{ $param['amount'] }}@endif">
                                </div>
                                <div class="form-group">
                                    <label for="user">Users</label>
                                    <input type="text" name="user" class="form-control" id="user" value="@if(isset($param['amount'])){{ $param['user'] }}@endif">
                                </div>
                            </div>
                            <div class="col-md-4 float-left">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select name="state" class="form-control" id="state">
                                        <option @if(isset($param['state']) && $param['state'] == 1) selected @endif value="1">{{ config('const.orders_state')[1] }}</option>
                                        <option @if(isset($param['state']) && $param['state'] == 2) selected @endif value="2">{{ config('const.orders_state')[2] }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 float-left">
                <table class="table table-hover table-bordered text-center">
                    <thead class="background-blue color-white">
                    <th>
                    <td>Code</td>
                    <td>Amount</td>
                    <td>Status</td>
                    <td>State</td>
                    <td>Users</td>
                    <td>Actions</td>
                    </th>
                    </thead>
                    <tbody>
                    @if(!empty($carts))
                        @foreach($carts as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->code }}</td>
                                <td>{{ $value->amount }}</td>
                                <td>{{ $value->status }}</td>
                                <td>{{ $value->state }}</td>
                                <td>{{ $value->name }}</td>
                                <td>
                                    <a href="{{ url('/admin/cart/'.$value->id.'/edit') }}"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="col-md-12 pull-right">
                    {!! $carts->render() !!}
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
@endsection
