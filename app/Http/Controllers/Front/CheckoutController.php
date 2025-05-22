<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cart;
use DB;
use Session;

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
}
