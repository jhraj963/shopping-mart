<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cart;
use DB;
use Session;
use Mail;
use App\Mail\InvoiceMail;

class CheckoutController extends Controller
{

    //__checkout page
    public function Checkout()
    {
        if (!Auth::check()) {
            $notification = array('messege' => 'Login Your Account!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
        $content = Cart::content();
        return view('frontend.cart.checkout', compact('content'));
    }

    //__apply coupn__
    public function ApplyCoupon(Request $request)
    {

        $check = DB::table('coupons')->where('coupon_code', $request->coupon)->first();
        if ($check) {
            //__coupon exist
            if (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($check->valid_date))) {
                session::put('coupon', [
                    'name' => $check->coupon_code,
                    'discount' => $check->coupon_amount,
                    'after_discount' => Cart::subtotal() - $check->coupon_amount
                ]);
                $notification = array('messege' => 'Coupon Applied!', 'alert-type' => 'success');
                return redirect()->back()->with($notification);
            } else {
                $notification = array('messege' => 'Expired Coupon Code!', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = array('messege' => 'Invalid Coupon Code! Try again.', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    //__remove coupon__
    public function RemoveCoupon()
    {
        Session::forget('coupon');
        $notification = array('messege' => 'Coupon removed!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }



    //__orderplace__
    public function OrderPlace(Request $request)
    {
        if ($request->payment_type == "Hand Cash") {

            $order = array();
            $order['user_id'] = Auth::id();
            $order['c_name'] = $request->c_name;
            $order['c_phone'] = $request->c_phone;
            $order['c_country'] = $request->c_country;
            $order['c_address'] = $request->c_address;
            $order['c_email'] = $request->c_email;
            $order['c_zipcode'] = $request->c_zipcode;
            $order['c_city'] = $request->c_city;
            $order['c_extra_phone'] = $request->c_extra_phone;

            if (Session::has('coupon')) {
                $order['subtotal'] = Cart::subtotal();
                $order['coupon_code'] = Session::get('coupon')['name'];
                $order['coupon_discount'] = Session::get('coupon')['discount'];
                $order['after_discount'] = Session::get('coupon')['after_discount'];
            } else {
                $order['subtotal'] = Cart::subtotal();
            }
            $order['total'] = Cart::subtotal();
            $order['payment_type'] = $request->payment_type;
            $order['tax'] = 0;
            $order['shipping_charge'] = 0;
            $order['order_id'] = rand(10000, 999999);
            $order['status'] = 0;
            $order['date'] = date('d-m-Y');
            $order['month'] = date('F');
            $order['year'] = date('Y');

            $order_id = DB::table('orders')->insertGetId($order);

            Mail::to($request->c_email)->send(new InvoiceMail($order));

            //Order Details

            $content = Cart::content();

            $details = array();
            foreach ($content as $row) {
                $details['order_id'] = $order_id;
                $details['product_id'] = $row->id;
                $details['product_name'] = $row->name;
                $details['color'] = $row->options->color;
                $details['size'] = $row->options->size;
                $details['quantity'] = $row->qty;
                $details['single_price'] = $row->price;
                $details['subtotal_price'] = $row->price * $row->qty;

                DB::table('order_details')->insert($details);
            }

            Cart::destroy();
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            return redirect()->to('/')->with('success', 'Your Oder Successfully Placed!');

            // AamarPay Gateway
        } elseif ($request->payment_type == "AamarPay") {


            $aamarpay = DB::table('payment_gateway_bd')->first();
            if ($aamarpay->store_id == NULL) {
                return redirect()->back()->with('error', 'Please setting your payment gateway!');
            }

            if ($aamarpay->status == 1) {
                $url = 'https://secure.aamarpay.com/jsonpost.php'; // live url https://secure.aamarpay.com/request.php
            } else {
                $url = 'https://sandbox.aamarpay.com/jsonpost.php';
            }

            $tran_id = "test" . rand(1111111, 9999999); //unique transection id for every transection

            $currency = "BDT"; //aamarPay support Two type of currency USD & BDT

            $amount = floatval(preg_replace('/[^\d.]/', '', Cart::subtotal()));   //10 taka is the minimum amount for show card option in aamarPay payment gateway

            //For live Store Id & Signature Key please mail to support@aamarpay.com
            $store_id = $aamarpay->store_id;

            $signature_key = $aamarpay->signature_key;
            // $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";

            // $url = "https://​sandbox​.aamarpay.com/jsonpost.php"; // for Live Transection use "https://secure.aamarpay.com/jsonpost.php"
            // $url = "https://secure.aamarpay.com/jsonpost.php";

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "store_id": "' . $store_id . '",
                "tran_id": "' . $tran_id . '",
                "success_url": "' . route('success') . '",
                "fail_url": "' . route('fail') . '",
                "cancel_url": "' . route('cancel') . '",
                "amount": "' . $amount . '",
                "currency": "' . $currency . '",
                "signature_key": "' . $signature_key . '",
                "desc": "Merchant Registration Payment",
                "cus_name": "' . $request->c_name . '",
                "cus_email": "'. $request->c_email . '",
                "cus_add1":  "' . $request->c_address . '",
                "cus_add2": "Mohakhali DOHS",
                "cus_city":  "' . $request->c_city . '",
                "cus_state": "Dhaka",
                "cus_postcode": "' . $request->c_zipcode . '",
                "cus_country": "' . $request->c_country . '",
                "cus_phone": "' . $request->c_phone . '",
                "type": "json"
            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // dd($response);
            // dd([
            //     'store_id' => $store_id,
            //     'signature_key' => $signature_key
            // ]);
            $responseObj = json_decode($response);

            if (isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

                $paymentUrl = $responseObj->payment_url;
                // dd($paymentUrl);
                return redirect()->away($paymentUrl);
            } else {
                echo $response;
                // dd($response);
            }
        }
    }

    //Other Method

    public function success(Request $request)
    {
        $order = array();
        $order['user_id'] = Auth::id();
        $order['c_name'] = $request->cus_name;
        $order['c_phone'] = $request->opt_c;
        $order['c_country'] = $request->opt_a;
        $order['c_address'] = $request->opt_d;
        $order['c_email'] = $request->cus_email;
        $order['c_city'] = $request->opt_b;
        if (Session::has('coupon')) {
            $order['subtotal'] = Cart::subtotal();
            $order['coupon_code'] = Session::get('coupon')['name'];
            $order['coupon_discount'] = Session::get('coupon')['discount'];
            $order['after_dicount'] = Session::get('coupon')['after_discount'];
        } else {
            $order['subtotal'] = Cart::subtotal();
        }
        $order['total'] = Cart::subtotal();
        $order['payment_type'] = 'Aamarpay';
        $order['tax'] = 0;
        $order['shipping_charge'] = 0;
        $order['order_id'] = rand(10000, 900000);
        $order['status'] = 1;
        $order['date'] = date('d-m-Y');
        $order['month'] = date('F');
        $order['year'] = date('Y');

        $order_id = DB::table('orders')->insertGetId($order);


        Mail::to(Auth::user()->email)->send(new InvoiceMail($order));

        //order details
        $content = Cart::content();

        $details = array();
        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['single_price'] = $row->price;
            $details['subtotal_price'] = $row->price * $row->qty;
            DB::table('order_details')->insert($details);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        return redirect()->to('home')->with('success', 'Your Oder Successfully Placed!');
    }

    public function fail(Request $request)
    {
        return $request;
    }

    public function cancel()
    {
        return 'Canceled';
    }
}
