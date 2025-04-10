<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;

// use Intervention\Image\Facades\Image;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // prduct show

    public function index(Request $request)
    {
        if ($request->ajax()) {
              $imgurl='files/product';
            // $data = Product::latest()->get();
            $product="";
            $query=DB::table('products')->leftJoin('categories', 'products.category_id','categories.id')
                        ->leftJoin('subcategories', 'products.subcategory_id','subcategories.id')
                        ->leftJoin('brands', 'products.brand_id','brands.id');

            if ($request->category_id){
                $query->where('products.category_id', $request->category_id);
            }

            if ($request->brand_id){
                $query->where('products.brand_id', $request->brand_id);
            }

            if ($request->warehouse) {
                $query->where('products.warehouse', $request->warehouse);
            }

            if ($request->status==1) {
                $query->where('products.status',1);
            }

            if ($request->status==0) {
                $query->where('products.status',0);
            }

            $product=$query->select('products.*', 'categories.category_name','subcategories.subcategory_name', 'brands.brand_name')
                        ->get();

            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('thumbnail', function($row) use ($imgurl){
                    return '<img src="'. $imgurl.'/'.$row->thumbnail.'" height="35" width="40">';
                })
                // ->editColumn('category_name', function($row){
                //     return $row->category->category_name;
                // })
                // ->editColumn('subcategory_name', function($row){
                //     return $row->subcategory->subcategory_name;
                // })
                // ->editColumn('brand_name', function($row){
                //     return $row->brand->brand_name;
                // })
                ->editColumn('featured', function($row){
                    if ($row->featured==1){
                        return '<a href="#" data-id="' . $row->id . '" class="deactive_featurd"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">Active</span> </a>';
                    }else{
                        return '<a href="#" data-id="' . $row->id . '" class="active_featurd"> <i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">Deactive</span> </a>';
                    }
                })
                ->editColumn('today_deal', function($row){
                    if ($row->today_deal==1){
                        return '<a href="#" data-id="' . $row->id . '" class="deactive_deal"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">Active</span> </a>';
                    }else{
                        return '<a href="#" data-id="' . $row->id . '" class="active_deal"> <i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">Deactive</span> </a>';
                    }
                })
                ->editColumn('status', function($row){
                    if ($row->status==1){
                        return '<a href="#" data-id="' . $row->id . '" class="deactive_status"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">Active</span> </a>';
                    }else{
                        return '<a href="#" data-id="' . $row->id . '" class="active_status"> <i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">Deactive</span> </a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="' . route('product.edit', [$row->id]) . '" class="btn btn-primary btn-sm  edit">Edit <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="" class="btn btn-info btn-sm  edit">Show <i class="fas fa-eye"></i></a>
                            <a href="' . route('product.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete">Delete <i class="fa-solid fa-delete-left"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action', 'thumbnail', 'category_name', 'subcategory_name', 'brand_name', 'featured', 'today_deal', 'status'])
                ->make(true);
        }

        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $warehouse=DB::table('warehouses')->get();

        return view('admin.product.index', compact('category','brand', 'warehouse'));
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
        $data['product_slider'] = $request->product_slider;
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


    // Product Edit
    public function edit($id)
    {
        $product=DB::table('products')->where('id', $id)->first();
        $category=Category::all();
        $brand=Brand::all();
        $warehouse = DB::table('warehouses')->get();
        $pickup_point = DB::table('pickup_point')->get();

        return view('admin.product.edit', compact('product', 'category', 'brand', 'warehouse', 'pickup_point'));
    }

    // not featured

    public function notfeatured($id)
    {
        DB::table('products')->where('id', $id)->update(['featured'=>0]);
        return response()->json('Product Not Featured');
    }

    // active featured

    public function activefeatured($id)
    {
        DB::table('products')->where('id', $id)->update(['featured'=>1]);
        return response()->json('Product Successfully Featured');
    }

    // not deal

    public function notdeal($id)
    {
        DB::table('products')->where('id', $id)->update(['today_deal'=>0]);
        return response()->json('Product Not Toaday Deal');
    }

    // active deal

    public function activedeal($id)
    {
        DB::table('products')->where('id', $id)->update(['today_deal'=>1]);
        return response()->json('Product Successfully Toaday Deal');
    }

    // not status

    public function notstatus($id)
    {
        DB::table('products')->where('id', $id)->update(['status'=>0]);
        return response()->json('Product Status Deactivated');
    }

    // active status

    public function activestatus($id)
    {
        DB::table('products')->where('id', $id)->update(['status'=>1]);
        return response()->json('Product Status Activated');
    }



    // delete product

    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return response()->json('Product Deleted Successfully');
    }

}
