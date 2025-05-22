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
    public function Checkout()
    {
        if (!Auth::check()){
            return redirect()->back()->with('error', 'Login Your Account!');
        }

        $content = Cart::content();
        return view('frontend.cart.checkout',compact('content'));
    }


    // Apply Coupon
    public function ApplyCoupon(Request $request)
    {
        $check = DB::table('coupons')->where('coupon_code', $request->coupon)->first();

        if ($check) {
            if (date('Y-m-d') <= date('Y-m-d', strtotime($check->valid_date))) {
                $subtotal = floatval(str_replace(',', '', Cart::subtotal()));
                $discount = $check->coupon_amount;

                session()->put('coupon', [
                    'name' => $check->coupon_code,
                    'discount' => $discount,
                    'after_discount' => $subtotal - $discount,
                ]);

                return redirect()->back()->with('success', 'Coupon Successfully Applied!');
            } else {
                return redirect()->back()->with('error', 'Expired Coupon Code!');
            }
        } else {
            return redirect()->back()->with('error', 'Coupon Code Is Invalid!');
        }
    }


    // Remove Coupon

    public function RemoveCoupon()
    {
        Session::forget('coupon');
        return redirect()->back()->with('success', 'Coupon Removed!');
    }


    // Order Place
    public function OrderPlace(Request $request)
    {
        $order=array();
        $order['user_id']=Auth::id();
        $order['c_name']=$request->c_name;
        $order['c_phone']=$request->c_phone;
        $order['c_country']=$request->c_country;
        $order['c_address']=$request->c_address;
        $order['c_email']=$request->c_email;
        $order['c_zipcode']=$request->c_zipcode;
        $order['c_city']=$request->c_city;
        $order['c_extra_phone']=$request->c_extra_phone;

        if(Session::has('coupon')){
            $order['subtotal']=Cart::subtotal();
            $order['coupon_code']=Session::get('coupon')['name'];
            $order['coupon_discount']=Session::get('coupon')['discount'];
            $order['after_discount']=Session::get('coupon')['after_discount'];
        }else{
            $order['subtotal'] = Cart::subtotal();
        }
        $order['total'] = Cart::subtotal();
        $order['payment_type']=$request->payment_type;
        $order['tax']=0;
        $order['shipping_charge']=0;
        $order['order_id']=rand(10000, 999999);
        $order['status']=0;
        $order['date']=date('d-m-Y');
        $order['month']=date('F');
        $order['year']=date('Y');

        $order_id=DB::table('orders')->insertGetId($order);

        Mail::to($request->c_email)->send(new InvoiceMail($order));

        //Order Details

        $content=Cart::content();

        $details=array();
        foreach($content as $row){
            $details['order_id']=$order_id;
            $details['product_id']=$row->id;
            $details['product_name']=$row->name;
            $details['color']=$row->options->color;
            $details['size']=$row->options->size;
            $details['quantity']=$row->qty;
            $details['single_price']=$row->price;
            $details['subtotal_price']=$row->price*$row->qty;

            DB::table('order_details')->insert($details);
        }

        Cart::destroy();
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        return redirect()->to('/')->with('success', 'Your Oder Successfully Placed!');
    }

}
