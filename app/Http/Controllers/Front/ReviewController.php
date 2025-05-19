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


    //Review For Website As A Customer
    public function write()
    {
        return view('user.review_write');
    }

    //Review Store For Website As A Customer
    public function StoreWebsiteReview(Request $request)
    {
        $check=DB::table('wbreviews')->where('user_id', Auth::id())->first();
        if($check){
                    return redirect()->back()->with('error', 'Review Already Exists!');
        }

        $data = array();
        $data['user_id'] = Auth::id();
        $data['name'] = $request->name;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;
        $data['review_date'] = date('d-m-Y');
        $data['status'] = 0;

        DB::table('wbreviews')->insert($data);


        return redirect()->back()->with('success', 'Thanks For Review For Our Website');
    }
}
