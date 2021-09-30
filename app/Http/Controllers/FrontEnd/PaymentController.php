<?php

namespace App\Http\Controllers\FrontEnd;

use App\Factory\Paygates\MoMo\MoMo;
use App\Factory\Paygates\Paypal\PayPal;
use App\Factory\Paygates\VNPAY\VNPAY;
use App\Http\Controllers\Controller;
use App\Models\Paygate;
use App\Support\ResponseHelper;
use Illuminate\Http\Request;
use App\Factory\Paygates\NganLuong\NLCheckout;
use Ramsey\Uuid\Type\Integer;

class PaymentController extends Controller
{
    /**
     * Define code of pay gate here
     */
    const CODE_PAYPAL = 'paypal';
    const CODE_NGANLUONG = 'nganluong';
    const CODE_VN_PAY = 'vnpay';
    const CODE_MOMO = 'momo';

    /**
     * Function controller init param and get data payment
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function payPalInitPayment(Request $request)
    {
        $paypal = new PayPal();
        $getConfig = $paypal->getData();
        if (!empty($getConfig)) {
            $config = json_decode($getConfig->configs, true);
            $getConfig->API_USERNAME = $config['API_USERNAME'];
            $getConfig->API_PASSWORD = $config['API_PASSWORD'];
            $getConfig->API_SIGNATURE = $config['API_SIGNATURE'];
            $getConfig->SECRET_ID = $config['SECRET_ID'];
            $getConfig->CLIENT_ID = $config['CLIENT_ID'];
            $getConfig->SANBOX_ACCOUNT = $config['SANBOX_ACCOUNT'];
            $getConfig->SECRET_ID = $config['VERSION'];
        }

        return app()->make(ResponseHelper::class)->success($getConfig);
    }

    /**
     * Controller init payment has using data from client and get data config in server
     *
     * @param Request $request
     * @return bool
     */
    public function nganLuongInitPayment(Request $request)
    {
        $paygate = Paygate::where('code', self::CODE_NGANLUONG)->first();
        if (empty($paygate)) {
            return redirect('/');
        }
        $param = $request->all();
        if ($param['txt_gia'] < 2000) {
            return redirect('/');
        }
        /**
         * The information has get in database
         * code = nganluong
         */
        $NGANLUONG_URL = $paygate->url;                                     // URL checkout
        $config = json_decode($paygate->configs, true);
        $RECEIVER = $config['RECEIVER'];                                    // Email tài khoản Ngân Lượng
        $MERCHANT_ID = $config['MERCHANT_ID'];                              // Mã kết nối
        $MERCHANT_PASS = $config['MERCHANT_PASS'];                          // Mật khẩu kết nối

        // URL sẽ trả về khi thanh toán
        $receiver = $RECEIVER;
        $order_code = 'NL_' . time();                                       // Mã đơn hàng sẽ nhận từ bảng cart
        $return_url = url('/ngan-luong/success');
        $cancel_url= url('/ngan-luong/cancel');
        $notify_url = url('/ngan-luong/success');

        // Thông tin và giá cả của giỏ hàng lẫn người dùng
        $txh_name = $param['txh_name'];
        $txt_email = $param['txt_email'];
        $txt_phone = $param['txt_phone'];
        $price = (int) $param['txt_gia'];

        // Khởi tạo thông tin giao dịch
        $transaction_info = "Thong tin giao dich";
        $currency = $config['currency'];
        $quantity = 1;                                                      // Số đơn thanh toán mặc định là 1
        $tax = 0;                                                           // Thuế mặc định là 0 nếu có thì thường là 10%
        $discount = 0;                                                      // Mã giảm giá mặc định là 0
        $fee_cal = 0;                                                       // Mã miễn thuế mặc định là 0
        $fee_shipping = 0;                                                  // Mã free ship mặc định là 0
        $order_description = "Thong tin don hang: " . $order_code;
        $buyer_info = $txh_name . "*|*" . $txt_email . "*|*" . $txt_phone;
        $affiliate_code = "";                                               // Mã đối tác mặc định ""

        // Khai báo đối tượng của lớp NL_Checkout
        $nl = new NLCheckout();
        $nl->nganluong_url = $NGANLUONG_URL;
        $nl->merchant_site_code = $MERCHANT_ID;
        $nl->secure_pass = $MERCHANT_PASS;

        // Tạo link thanh toán đến nganluong.vn
        $url = $nl->buildCheckoutUrlExpand(
            $return_url, $receiver, $transaction_info, $order_code, $price, $currency, $quantity, $tax, $discount ,
            $fee_cal, $fee_shipping, $order_description, $buyer_info , $affiliate_code
        );

        // verify response url
        return '<meta http-equiv="refresh" content="0; url='.$url.'" >';
    }

    /**
     * Controller success payment from nganluong.vn and update order, redirect page here
     *
     * @param Request $request
     * @return bool
     */
    public function nganLuongSuccessPayment(Request $request)
    {
        $paygate = Paygate::where('code', self::CODE_NGANLUONG)->first();
        /**
         * The information has get in database
         * code = nganluong
         */
        $param = $request->all();
        $config = json_decode($paygate->configs, true);

        $transaction_info = $param['transaction_info'];
        $order_code = $param['order_code'];
        $price = $param['price'];
        $payment_id = $param['payment_id'];
        $payment_type = $param['payment_type'];
        $error_text = $param['error_text'];
        $secure_code = $param['secure_code'];
        //Khai báo đối tượng của lớp NL_Checkout
        $nl = new NLCheckout();
        $nl->merchant_site_code = $config['MERCHANT_ID'];
        $nl->secure_pass = $config['MERCHANT_PASS'];
        //Tạo link thanh toán đến nganluong.vn
        $checkpay= $nl->verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code);
        if ($checkpay) {
            // TODO Thanh toán thành công cập nhật thông tin đơn hàng tại đây
            return true;
        } else {
           return false;
        }
    }

    /**
     * Controller cancel payment from user and redirect pages here
     *
     * @param Request $request
     * @return bool
     */
    public function nganLuongCancelPayment(Request $request)
    {
        return false;
    }

    /**
     * Controller payment failed and redirect pages here
     *
     * @param Request $request
     * @return bool
     */
    public function nganLuongFailedPayment(Request $request)
    {
        return false;
    }

    /**
     * Controller init payment of vn_pay
     *
     * @param Request $request
     * @return bool
     */
    public function vnPayInitPayment(Request $request)
    {
        $payGate = Paygate::where('code', self::CODE_VN_PAY)->first();
        if (empty($payGate)) {
            return redirect('/');
        }
        $param = $request->all();
        $configs = json_decode($payGate->configs, true);
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = url('/vn-pay/return');
        $vnp_TmnCode = $configs['vnp_TmnCode'];                                // Mã website tại VNPAY
        $vnp_HashSecret = $configs['vnp_HashSecret'];                          // Chuỗi bí mật

        $vnp_TxnRef = date('YmdHis');                                   //Mã đơn hàng lấy từ bảng cart trong DB
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $param['amount'] * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        $vnPay = new VNPAY();
        $renderUrl = $vnPay->doDirectPayment($inputData, $vnp_Url, $vnp_HashSecret);

        return '<meta http-equiv="refresh" content="0; url='.$renderUrl.'" >';
    }

    /**
     * Function process data vnpay return
     *
     * @param Request $request
     */
    public function vnPayReturn(Request $request)
    {
        dd($request->all());
    }

    /**
     * Controller payment using momo e-wallet
     *
     * @param Request $request
     * @return mixed
     */
    public function momoInitPayment(Request $request)
    {
        header('Content-type: text/html; charset=utf-8');

        $paygate = Paygate::where('code', self::CODE_MOMO)->first();
        $config = $paygate->configs;
        $array = json_decode($config, true);
        $param = $request->all();
        $momo = new MoMo();

        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        /**
         * Create param
         */
        $partnerCode = $array["partnerCode"];
        $accessKey = $array["accessKey"];
        $serectkey = $array["secretKey"];
        $orderId = time() . "";                              // Mã đơn hàng trong bảng cart
        $orderInfo = "Thông tin của đơn hàng";
        $amount = $param["amount"];
        $notifyurl = url('/momo/ipn');                 // Lưu ý: link notifyUrl không phải là dạng localhost
        $returnUrl = url('/momo/result');

        $requestId = time() . "";
        $requestType = "captureMoMoWallet";
        $extraData = (isset($param["extraData"]) ? $param["extraData"] :  "merchantName=MoMo Partner");
        //before sign HMAC SHA256 signature
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
        $data = array(
            "accessKey" => $accessKey,
            "partnerCode" => $partnerCode,
            "requestType" => "captureMoMoWallet",
            "notifyUrl" => $notifyurl,
            "returnUrl" => $returnUrl,
            "orderId" => $orderId,
            "amount" => $param['amount'],
            "orderInfo" => "Order info",
            "requestId" => $requestId,
            "extraData" => $extraData,
            "signature" => $signature,
        );
        $result = $momo->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);   // decode json

        //Just a example, please check more in there
        return $jsonResult;
    }

    /**
     * Controller init payment using momo e-wallet
     *
     * @param Request $request
     */
    public function momoResult(Request $request)
    {
        dd($request->all());
    }
}
