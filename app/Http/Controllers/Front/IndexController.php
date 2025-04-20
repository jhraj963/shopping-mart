<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $category=DB::table('categories')->get();
        $bannerproduct=Product::where('status',1)->where('product_slider',1)->latest()->first();
        $featured=Product::where('status', 1)->where('featured',1)->orderBy('id','DESC')->limit(16)->get();
        $popular_product=Product::where('status', 1)->orderBy('product_views','DESC')->limit(16)->get();
        $trendy_product=Product::where('status', 1)->where('trendy', 1)->orderBy('product_views','DESC')->limit(10)->get();

        return view('frontend.index', compact('category', 'bannerproduct', 'featured', 'popular_product', 'trendy_product'));
    }

    // show single product

    public function ProductDetails($slug)
    {
        $product=Product::where('slug', $slug)->first();
                 Product::where('slug', $slug)->increment('product_views');
        $related_product = DB::table('products')->where('subcategory_id', $product->subcategory_id)->orderBy('id', 'DESC')->take(10)->get();
        $review=Review::where('product_id', $product->id)->orderBy('id','DESC')->take(8)->get();

        return view('frontend.product.product_details', compact('product', 'related_product','review'));

    }

    // Quick View Product
    public function ProductQuickView($id)
    {
        $product=Product::where('id',$id)->first();
        return view('frontend.product.quick_view',compact('product'));
    }
}
