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
                        <h1 class="m-0 text-dark">List all products</h1>
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
                        <a href="{{ url('/admin/product/create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add new</a>
                    </div>
                </div>

                <div class="col-md-12 float-left card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quick search</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('/admin/product/search') }}" method="GET" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="col-md-4 float-left border-right-form-search">
                                <div class="form-group">
                                    <label for="name">Name product</label>
                                    <input type="text" name="name" class="form-control" id="name" value="@if(isset($param)){{ $param['name'] }} @endif">
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category_id" class="form-control" id="category">
                                        <option value="">-------------</option>
                                        @if(!empty($categories))
                                            @foreach($categories as $value)
                                                <option @if(isset($param) && $value->id === $param['category_id']) selected @endif value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 float-left border-right-form-search">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" class="form-control" id="price" value="@if(isset($param)){{ $param['price'] }}@endif">
                                </div>
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" name="code" class="form-control" id="code" value="@if(isset($param)){{ $param['code'] }}@endif">
                                </div>
                            </div>
                            <div class="col-md-4 float-left">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option @if(isset($param) && $param['status'] === 1) selected @endif value="1">{{ config('langEN.product.status.in_stock') }}</option>
                                        <option @if(isset($param) && $param['status'] === 0) selected @endif value="0">{{ config('langEN.product.status.out_of_stock') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="qty">Quantity</label>
                                    <input type="number" name="qty" class="form-control" id="qty" value="@if(isset($param)){{ $param['qty'] }}@endif">
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

            <div class="col-md-12 float-left">
                <table class="table table-hover table-bordered text-center">
                    <thead class="background-blue color-white">
                    <th>
                        <td>Name</td>
                        <td>Category</td>
                        <td>Price</td>
                        <td>Code</td>
                        <td>Status</td>
                        <td>Quantity</td>
                        <td>Action</td>
                    </th>
                    </thead>
                    <tbody>
                    @if(!empty($products))
                        @foreach($products as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->category->name }}</td>
                                <td>{{ $value->price }}</td>
                                <td>{{ $value->code }}</td>
                                <td>{{ $value->status }}</td>
                                <td>{{ $value->qty }}</td>
                                <td>
                                    <a href="{{ url('/admin/product/'.$value->id.'/edit') }}"><i class="fas fa-edit"></i></a>
                                    |
                                    <a href="{{ url('/admin/product/' . $value->id . '/show') }}"><i class="fas fa-eye"></i></a>
                                    |
                                    <a href="#" onclick="checkDataDependent({{ $value->id }})"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="col-md-12 pull-right">
                    {!! $products->render() !!}
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- Modal confirm delete product -->
    <div id="confirm_delete_product"  class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm product deletion</h4>
                </div>
                <div class="modal-body">
                    <p class="text-danger">This product has data dependent.</p>
                    <p class="text-danger">Are you sure you want to delete?</p>
                    <input type="hidden" name="id" value="" id="id-product-delete">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="btn-delete-product">Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal confirm delete product -->
    <div id="alert_delete_product"  class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Product deletion</h4>
                </div>
                <div class="modal-body">
                    <p class="text-danger" id="txt-alert">Product and related data deleted successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="reloadPage()">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('custom-js')
    <script>
        $('#btn-delete-product').onclick(function () {
            let id = $('#id-product-delete').val();
            destroyProduct(id);
        });
        /**
         * Function call api check data dependent of product
         *
         * @param id of product
         */
        function checkDataDependent(id) {
            $.ajax({
                url: '{{ url('/admin/product/data-dependent') }}',
                type: 'get',
                data: {
                    id : id
                },
                success: function (response) {
                    if (response.code === 200) {
                        destroyProduct(id);
                    } else {
                        return null;
                    }
                },
                error: function (err) {
                    $('#confirm_delete_product').modal('show');
                    $('#product-delete').val(id);
                }
            });
        }

        /**
         * Function call api delete data and all data dependent
         *
         * @param id of product
         */
        function destroyProduct(id) {
            $.ajax({
                url: '{{ url('/admin/product/delete') }}',
                type: 'get',
                data: {
                    id : id
                },
                success: function (response) {
                    if (response.code === 200) {
                        $('#alert_delete_product').modal('show');
                    }
                },
                error: function (err) {
                    $('#alert_delete_product').modal('show');
                    $('#txt-alert').text('Product deletion failed, please check the system again!');
                }
            });
        }
    </script>
@endsection
