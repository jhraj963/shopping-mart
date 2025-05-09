<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // store review
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

        $check=DB::table('reviews')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if($check){
            return redirect()->back()->with('error', 'You Already Reviewed This Product');
        }

        // Query
        $data=array();
        $data['user_id']=Auth::id();
        $data['product_id']=$request->product_id;
        $data['review']=$request->review;
        $data['rating']=$request->rating;
        $data['review_date']=date('d-m-Y');
        $data['review_month']=date('F');
        $data['review_year']=date('Y');

        DB::table('reviews')->insert($data);


        return redirect()->back()->with('success', 'Thanks For Review');
    }


    // Add Wishlist

    // public function AddWishlist($id)
    // {
    //     $check=DB::table('wishlists')->where('product_id', $id)->where('user_id', Auth::id())->first();

    //     if($check){
    //         return redirect()->back()->with('error', 'Already Add This Product On Wishlist');
    //     }else{
    //         $data=array();
    //         $data['product_id']=$id;
    //         $data['user_id']= Auth::id();
    //         DB::table('wishlists')->insert($data);
    //         return redirect()->back()->with('success', 'Product Added On Wishlist');
    //     }
    // }

    public function AddWishlist($id)
    {

        if(Auth::check()){
            $check=DB::table('wishlists')->where('product_id',$id)->where('user_id',Auth::id())->first();
               if ($check) {
                    return redirect()->back()->with('error', 'Already have it on your wishlist !');
               }else{
                    $data=array();
                    $data['product_id']=$id;
                    $data['user_id']=Auth::id();
                    $data['date']=date('d , F Y');
                    DB::table('wishlists')->insert($data);;
                    return redirect()->back()->with('success', 'Product added on wishlist!');
               }
        }
                    return redirect()->back()->with('error', 'Login Your Account!');
    }
}
