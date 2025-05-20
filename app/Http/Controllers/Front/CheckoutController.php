<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cart;

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
}
