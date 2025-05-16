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
        $brand=DB::table('brands')->where('front_page',1)->limit(30)->get();
        $category=DB::table('categories')->orderBy('category_name', 'ASC')->get();
        $bannerproduct=Product::where('status',1)->where('product_slider',1)->latest()->first();
        $featured=Product::where('status', 1)->where('featured',1)->orderBy('id','DESC')->limit(16)->get();
        $popular_product=Product::where('status', 1)->orderBy('product_views','DESC')->limit(16)->get();
        $random_product=Product::where('status', 1)->inRandomOrder()->limit(18)->get();
        $trendy_product=Product::where('status', 1)->where('trendy', 1)->orderBy('product_views','DESC')->limit(10)->get();
        $todaydeal=Product::where('status', 1)->where('today_deal', 1)->orderBy('id','DESC')->limit(8)->get();

        //For Home Category
        $home_category = DB::table('categories')->where('home_page',1)->orderBy('category_name','ASC')->get();

        return view('frontend.index', compact('category', 'bannerproduct', 'featured', 'popular_product', 'trendy_product','home_category', 'brand', 'random_product', 'todaydeal'));
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

    // Category Wise Product
    public function CategoryWiseProduct($id)
    {
        $category=DB::table('categories')->where('id',$id)->first();
        $subcategory=DB::table('subcategories')->where('category_id',$id)->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('category_id',$id)->paginate(20);
        $random_product = Product::where('status', 1)->inRandomOrder()->limit(18)->get();
        return view('frontend.product.category_product',compact('category','subcategory','brand','products', 'random_product'));
    }

    // Sub Category Wise Product
    public function SubcategoryWiseProduct($id)
    {
        $subcategory = DB::table('subcategories')->where('id', $id)->first();
        $childcategory=DB::table('childcategories')->where('subcategory_id',$id)->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('subcategory_id',$id)->paginate(20);
        $random_product = Product::where('status', 1)->inRandomOrder()->limit(18)->get();
        return view('frontend.product.subcategory_product',compact('subcategory','childcategory','brand','products', 'random_product'));
    }

    // Child Category Wise Product
    public function ChildcategoryWiseProduct($id)
    {
        $childcategory = DB::table('childcategories')->where('id', $id)->first();
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('childcategory_id',$id)->paginate(20);
        $random_product = Product::where('status', 1)->inRandomOrder()->limit(18)->get();
        return view('frontend.product.childcategory_product',compact('childcategory','category','brand','products', 'random_product'));
    }

    // Brand Wise Product
    public function BrandWiseProduct($id)
    {
        $brand = DB::table('brands')->where('id', $id)->first();
        $category=DB::table('categories')->get();
        $brands=DB::table('brands')->get();
        $products=DB::table('products')->where('brand_id',$id)->paginate(20);
        $random_product = Product::where('status', 1)->inRandomOrder()->limit(18)->get();
        return view('frontend.product.brand_product',compact('brand','category','brands','products', 'random_product'));
    }
}
