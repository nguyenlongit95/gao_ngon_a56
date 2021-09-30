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
                        <h1 class="m-0 text-dark">Customers detail</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Info customer</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="col-md-4 float-left border-right-form-search">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" readonly="readonly" name="name" class="form-control" id="name" value="{{ $customer->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" readonly="readonly" name="email" class="form-control" id="email" value="{{ $customer->email }}">
                                </div>
                            </div>
                            <div class="col-md-4 float-left border-right-form-search">
                                <div class="form-group">
                                    <label for="email_verified_at">Total number of ratting</label>
                                    <input type="text" readonly="readonly" name="email_verified_at" class="form-control" id="email_verified_at" value="{{ count($customer->ratting) }}">
                                </div>
                                <div class="form-group">
                                    <label for="remember_token">Total of favorite products</label>
                                    <input type="text" readonly="readonly" name="remember_token" class="form-control" id="remember_token" value="{{ count($customer->wishlist) }}">
                                </div>
                            </div>
                            <div class="col-md-4 float-left">
                                <div class="form-group">
                                    <label for="email_verified_at">Total orders</label>
                                    <input type="text" readonly="readonly" name="email_verified_at" class="form-control" id="email_verified_at" value="{{ count($customer->carts) }}">
                                </div>
                                <div class="form-group">
                                    <label for="remember_token">Total product purchased</label>
                                    <input type="text" readonly="readonly" name="remember_token" class="form-control" id="remember_token" value="{{ $totalProductPurchased }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="col-4">
                            <a href="#info_member" class="active" data-toggle="tab">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">Rattings</h3>
                                        <span class="float-right"><i class="fa fa-user font-size-20"></i></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="col-4">
                            <a href="#wish_list" data-toggle="tab">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">Wish list</h3>
                                        <span class="float-right"><i class="fas fa-boxes font-size-20"></i></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="col-4">
                            <a href="#list_orders" data-toggle="tab">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">List orders</h3>
                                        <span class="float-right"><i class="fas fa-cart-plus font-size-20"></i></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="info_member">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Rattings product</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="tbl-rattings" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product name</th>
                                        <th>Product code</th>
                                        <th>Star rate</th>
                                        <th>Time ratting</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($customer->ratting))
                                        @foreach($customer->ratting as $ratting)
                                        <tr>
                                            <td>{{ $ratting->id }}</td>
                                            <td><a href="{{ url('/admin/product/' . $ratting->id . '/show') }}">{{ $ratting->name }}</a></td>
                                            <td>{{ $ratting->code }}</td>
                                            <td>
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < $ratting->rattings)
                                                        <span class="fa fa-star star-checked"></span>
                                                    @else
                                                        <span class="fa fa-star star"></span>
                                                    @endif
                                                @endfor
                                            </td>
                                            <td>{{ $ratting->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Product name</th>
                                        <th>Product code</th>
                                        <th>Star rate</th>
                                        <th>Time ratting</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="wish_list">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Wish list</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="tbl-wish-list" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product name</th>
                                        <th>Product code</th>
                                        <th>Price</th>
                                        <th>Origin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($customer->wishlist))
                                        @foreach($customer->wishlist as $wishlist)
                                        <tr>
                                            <td>{{ $wishlist->id }}</td>
                                            <td><a href="{{ url('/admin/product/' . $wishlist->id . '/show') }}">{{ $wishlist->name }}</a></td>
                                            <td>{{ $wishlist->code }}</td>
                                            <td>{{ $wishlist->price }}</td>
                                            <td>{{ $wishlist->origin }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Product name</th>
                                        <th>Product code</th>
                                        <th>Price</th>
                                        <th>Origin</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="list_orders">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">List orders</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="tbl-list-orders" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cart code</th>
                                        <th>Amount</th>
                                        <th>Payment status</th>
                                        <th>State orders</th>
                                        <th>Address</th>
                                        <th>Delivery date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($customer->carts))
                                        @foreach($customer->carts as $cart)
                                        <tr>
                                            <td>{{ $cart->id }}</td>
                                            <td>{{ $cart->code }}</td>
                                            <td>{{ number_format($cart->amount, 0) }}</td>
                                            <td>{{ $cart->txt_status }}</td>
                                            <td>{{ $cart->txt_state }}</td>
                                            <td>{{ $cart->address }}</td>
                                            <td>{{ $cart->delivery_date }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Cart code</th>
                                        <th>Amount</th>
                                        <th>Payment status</th>
                                        <th>State orders</th>
                                        <th>Address</th>
                                        <th>Delivery date</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $('#tbl-rattings').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
        $('#tbl-wish-list').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('#tbl-list-orders').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>

    <style>
        .font-size-20 {
            font-size: 20px;
        }
        .dataTables_paginate {
            float: right;
        }
        .border-right-form-search {
            border-right: 1px #0000002b solid;
        }
        .dataTables_filter {
            float: right;
        }
        .dataTables_filter label {
            float: left;
        }
        .dataTables_filter label input {
            float: right;
            width: 150px;
            margin-left: 10px;
        }
        .star-checked {
            color: #ffb100;
        }
    </style>
@endsection
