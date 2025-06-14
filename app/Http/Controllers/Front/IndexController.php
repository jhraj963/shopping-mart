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
        $review=DB::table('wbreviews')->where('status', 1)->orderBy('id','DESC')->limit(15)->get();

        //For Home Category
        $home_category = DB::table('categories')->where('home_page',1)->orderBy('category_name','ASC')->get();
        //For Campaign
        $campaign = DB::table('campaigns')->where('status',1)->orderBy('id','DESC')->first();

        return view('frontend.index', compact('category', 'bannerproduct', 'featured', 'popular_product', 'trendy_product','home_category', 'brand', 'random_product', 'todaydeal','review', 'campaign'));
    }

    // show single product Details

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


    // Page View

    public function ViewPage($page_slug)
    {
        $page=DB::table('pages')->where('page_slug', $page_slug)->first();
        return view('frontend.page',compact('page'));
    }


    // Store Newsletter

    public function StoreNewsletter(Request $request)
    {

        $email = $request->email;
        $check = DB::table('newsletters')->where('email', $email)->first();
        if ($check) {
            return response()->json('Email Already Exist!');
        } else {
            $data = array();
            $data['email'] = $request->email;
            DB::table('newsletters')->insert($data);
            return response()->json('Thanks for subscribe us!');
        }
    }


    // Order Tracking
    public function OrderTracking()
    {
        return view('frontend.order_tracking');
    }

    // Check Order
    public function CheckOrder(Request $request)
    {
        $check=DB::table('orders')->where('order_id',$request->order_id)->first();
        if($check){
            $order = DB::table('orders')->where('order_id', $request->order_id)->first();
            $order_details = DB::table('order_details')->where('order_id', $order->id)->get();

            return view('frontend.order_details',compact('order', 'order_details'));
        }else{
            return redirect()->back()->with('error', 'No Order Found');
        }
    }


    // Contact Page

    public function Contact()
    {
        return view('frontend.contact');
    }

    // Contact Page

    public function Blog()
    {
        return view('frontend.blog');
    }

    // Campaign Product

    public function CampaignProduct($id)
    {
        $products = DB::table('campaign_product')->leftJoin('products', 'campaign_product.product_id', 'products.id')
            ->select('products.name', 'products.code', 'products.thumbnail','products.slug', 'campaign_product.*')
            ->where('campaign_product.campaign_id', $id)
            ->paginate(30);

        return view('frontend.campaign.product_list', compact('products'));
    }

    // show single Campaign product Details

    public function CampaignProductDetails($slug)
    {
        $product = Product::where('slug', $slug)->first();
                    Product::where('slug', $slug)->increment('product_views');
        $product_price=DB::table('campaign_product')->where('product_id', $product->id)->first();
        $related_product = DB::table('campaign_product')->leftJoin('products', 'campaign_product.product_id', 'products.id')
            ->select('products.*', 'campaign_product.*')
            ->inRandomOrder(15)->get();
        $review = Review::where('product_id', $product->id)->orderBy('id', 'DESC')->take(8)->get();

        return view('frontend.campaign.product_details', compact('product', 'related_product', 'review', 'product_price'));
    }
}
