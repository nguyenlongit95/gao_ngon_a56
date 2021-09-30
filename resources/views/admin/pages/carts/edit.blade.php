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
                        <h1 class="m-0 text-dark">Update cart</h1>
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
                        <!-- search form -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('/admin/cart/' . $cart->id . '/update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-md-9 float-left">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Basic information of card</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="code">Code of card <span class="text-danger">*</span></label>
                                    <input type="text" readonly class="form-control" id="code" value="{{ $cart->code }}">
                                </div>
                                <div class="form-group">
                                    <label for="user_id">User <span class="text-danger">*</span></label>
                                    <input type="text" readonly class="form-control" id="user_id" value="{{ $cart->user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount <span class="text-danger">($) *</span></label>
                                    <input type="number" class="form-control" name="amount" id="amount" value="{{ $cart->amount }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea name="address" id="address" class="form-control">{{ $cart->address }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>- The order and buyer code will not be edited as this is the original buyer's data.</p>
                                <p>- The <span class="text-danger">Amount</span> field is the total amount of the order.</p>
                                <p>- The QR-Code field will be rendered using the order's code and id.</p>
                                <p>- By default, the delivery date field will be empty</p>
                                <input type="submit" value="Update" class="float-right btn btn-primary">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 float-right">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">QR Code</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                {!! $qrCode !!}
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Status</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-control">
                                        <option value="0">{{ config('const.orders_status')[0] }}</option>
                                        <option value="1">{{ config('const.orders_status')[1] }}</option>
                                        <option value="2">{{ config('const.orders_status')[2] }}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">State</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">{{ config('const.orders_state')[1] }}</option>
                                        <option value="2">{{ config('const.orders_state')[2] }}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Delivery date</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="date" name="delivery_date" id="delivery_date" class="form-control" value="{{ $cart->delivery_date }}">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <!-- Detail cart -->
            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">List products in card</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product name</th>
                                <th>Code</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Price total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($cart->cartDetail))
                                @foreach($cart->cartDetail as $value)
                                    <form action="{{ url('/admin/cart-detail/' . $value->id . '/update') }}" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" id="_token_{{ $value->id }}" value="{{ csrf_token() }}">
                                        <tr>
                                            <td>
                                                {{ $value->id }}
                                            </td>
                                            <td>
                                                {{ $value->name }}
                                            </td>
                                            <td>
                                                {{ $value->code }}
                                            </td>
                                            <td>
                                                {{ number_format($value->price, 0) }}
                                            </td>
                                            <td>
                                               {{ $value->qty }}
                                            </td>
                                            <td>
                                                <span id="total_price_{{ $value->id }}">{{ number_format($value->qty * $value->price, 0) }}</span>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /. end cart -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    </script>

    <style>
        #example2_paginate {
            float: right;
        }
        .btn-update-qty {
            color: #007bff !important;
        }
        .btn-update-qty:hover {
            cursor: pointer;
            color: #0056b3 !important;
        }
    </style>
@endsection
