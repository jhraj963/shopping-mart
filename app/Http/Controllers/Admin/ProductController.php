<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Str;
// use Intervention\Image\Facades\Image;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Product Create

    public function create()
    {
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $pickup_point=DB::table('pickup_point')->get();
        $warehouse=DB::table('warehouses')->get();


        return view('admin.product.create', compact('category', 'brand', 'pickup_point', 'warehouse'));
    }

    // Product Store

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products|max:60',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'color' => 'required',
            'description' => 'required',
        ]);

        // find category id
        $subcategory=DB::table('subcategories')->where('id', $request->subcategory_id)->first();
        $slug = Str::slug($request->name, '-');

        $data=array();
        $data['name']=$request->name;
        $data['slug']= Str::slug($request->name, '-');
        $data['code']=$request->code;
        $data['category_id']= $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id ;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['pickup_point_id'] = $request->pickup_point_id;
        $data['unit'] = $request->unit;
        $data['tags'] = $request->tags;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $data['video'] = $request->video;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['warehouse'] = $request->warehouse;
        $data['description'] = $request->description;
        $data['featured'] = $request->featured;
        $data['today_deal'] = $request->today_deal;
        $data['status'] = $request->status;
        $data['admin_id'] = Auth::id();
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');

        // single image
        if($request->thumbnail){
            $thumbnail = $request->thumbnail;
            $photoname = $slug . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(600, 600)->save('files/product/' . $photoname);

        $data['thumbnail'] =$photoname;
        }

        // multiple image

        $images = array();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(600, 600)->save('files/product/' . $imageName);
                array_push($images, $imageName);
            }
        $data['images'] = json_encode($images);
        }

        DB::table('products')->insert($data);

        return redirect()->back()->with('success', 'Product Upload Successfully.');
    }



}
