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
                        <h1 class="m-0 text-dark">PayGates</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <form role="form" action="{{ url('/admin/paygates/'.$payGate->id.'/update') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section class="content">
                <div class="col-7 float-left">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Information</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ $payGate->name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Code <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="code" value="{{ $payGate->code }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Url <span class="icon-required">*</span></label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="url" value="{{ $payGate->url }}">
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="col-5 float-right">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Configs</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php $i = 1; ?>
                            @foreach($payGate->conf as $key=>$conf)
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{ $key }} <span class="icon-required">*</span></label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="{{ $key }}" value="{{ $conf }}">
                                </div>
                                <?php $i++; ?>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-pen"></i> Update</button>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>
            </section>
        </form>
        <!-- /.content -->
        @if($payGate->code === 'paypal')
            <div class="col-md-12">
                <h1>Demo Payment paypal here!</h1>
                <div id="paypal-button-container"></div>
                <!-- Render button here -->
                <!-- Change client id here -->
                <script src="https://www.paypal.com/sdk/js?client-id=AeYbemRrJQ94AKpZKo_sHSQJsdk8sH25QrfeDwiPhL8kEXxb962Xjs875juuJGsrPGCP5o2mb35jpqSq"></script>
                <script>
                    paypal.Buttons({
                        createOrder: function(data, actions) {
                            // This function sets up the details of the transaction, including the amount and line item details.
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        /**
                                         * Using ajax call API and add to value amount here
                                         */
                                        value: '0.01'
                                    }
                                }]
                            });
                        },
                        onApprove: function(data, actions) {
                            // This function captures the funds from the transaction.
                            return actions.order.capture().then(function(details) {
                                /**
                                 * Success transaction and redirect here
                                 * Using ajax call API update card and status collect
                                 */
                                alert('Transaction completed by ' + details.payer.name.given_name);
                            });
                        },
                        onError: function (err) {
                            /**
                             * For example, redirect to a specific error page
                             * Handle error transaction
                             */
                            alert(err);
                        }
                    }).render('#paypal-button-container');
                    //This function displays Smart Payment Buttons on your web page.
                </script>
            </div>
        @endif
        @if($payGate->code === 'nganluong')
            <div class="col-md-12 float-left">
                <h1>Demo payment using NganLuong.vn</h1>
                <p>
                    Thanh toán trực tuyến bằng thẻ ATM; Visa, Master Card;... qua <span class="text-danger">NganLuong.vn</span>
                </p>
                <form name="Test" method="post" action="{{ url('/ngan-luong/ngan-luong-init-payment') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table>
                        <tr><th><strong>Họ Tên:</strong></th><td><input type="text" name="txh_name" size="28" placeholder="Họ tên" /></td></tr>
                        <tr><th><strong>Email:</strong></th><td><input type="text" name="txt_email" size="28" placeholder="địa chỉ email" /></td></tr>
                        <tr><th><strong>Số điện thoại:</strong></th><td><input type="text" name="txt_phone" size="28" placeholder="Số điện thoại" /></td></tr>
                        <tr><th><strong>Số tền thanh toán:</strong></th><td><input name="txt_gia" type="text" min="2000" size="28" placeholder="Số tiền thanh toán" /></td></tr>
                        <tr><th></th><td><input  type="submit" name="submit" value="Thanh Toán"></td></tr>
                    </table>
                </form>
            </div>
        @endif
        @if($payGate->code === 'vnpay')
            <div class="col-md-12 float-left">
                <h1>Demo payment using VNPAY.vn</h1>
                <p>
                    Thanh toán trực tuyến bằng thẻ ATM; Visa, Master Card;... qua <span class="text-danger">vnpay.vn</span>
                </p>
                <form name="Test" method="post" action="{{ url('/vn-pay/vn-pay-init-payment') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table>
                        <tr><th><strong>Số tền thanh toán:</strong></th><td><input name="amount" type="text" min="2000" size="28" placeholder="Số tiền thanh toán" /></td></tr>
                        <tr><th></th><td><input  type="submit" name="submit" value="Thanh Toán"></td></tr>
                    </table>
                </form>
            </div>
        @endif
        @if($payGate->code === 'momo')
            <div class="col-md-12 float-left">
                <h1>Demo payment using MoMo</h1>
                <p>
                    Thanh toán trực tuyến bằng thẻ ATM; Visa, Master Card;... qua <span class="text-danger">momo.vn</span>
                </p>
                <form name="Test" method="post" action="{{ url('/momo/momo-init-payment') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table>
                        <tr><th><strong>Số tền thanh toán:</strong></th><td><input name="amount" type="text" size="28" placeholder="Số tiền thanh toán" /></td></tr>
                        <tr><th></th><td><input  type="submit" name="submit" value="Thanh Toán"></td></tr>
                    </table>
                </form>
            </div>
        @endif
    </div>
@endsection

@section('custom-js')
    <script>
        /**
         * Using ajax call API to get client-id
         */
        $.ajax({
            url: 'paypal/init-payment',
            type: 'get',
            data: {},
            success: function (response) {
                console.log(response);
            },
            errors: function (err) {
                console.log(err);
            },
        });
    </script>
@endsection
