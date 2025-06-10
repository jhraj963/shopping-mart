<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
use Image;
// use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

        public function index(Request $request)
        {
        if ($request->ajax()) {
            $data = DB::table('campaigns')->orderBy('id','DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<a href="#"><i class="text-danger"></i> <span class="badge badge-success">Active</span> </a>';
                    } else {
                        return '<a href="#"> <i class="text-success"></i> <span class="badge badge-danger">Inactive</span> </a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="" class="btn btn-info btn-sm  edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal">Edit <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="' . route('campaign.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete">Delete <i class="fa-solid fa-delete-left"></i></a>
                            <a href="' . route('campaign.product', [$row->id]) . '" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

        return view('admin.offer.campaign.index');
        }

    //campaingn Store

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:campaigns|max:60',
            'start_date' => 'required',
            'image' => 'required',
            'discount' => 'required',
        ]);


        $data = array();
        $data['title'] = $request->title;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = $request->status;
        $data['discount'] = $request->discount;
        $data['month'] = date('F');
        $data['year'] = date('Y');

        $photo = $request->image;
        $slug = Str::slug($request->title, '-');
        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        // $photo->move('files/campaign/', $photoname); //without image intervention
        Image::make($photo)->resize(858, 476)->save('files/campaign/'. $photoname); //Image Intervention
        $data['image'] = 'files/campaign/' . $photoname;


        DB::table('campaigns')->insert($data);
        return redirect()->back()->with('success', 'Campaign Inserted Successfully.');
    }


        //Edit Campaign

    public function edit($id)
    {
        $data=DB::table('campaigns')->where('id',$id)->first();
        return view('admin.offer.campaign.edit',compact('data'));
    }

//update campaign

    public function update(Request $request)
    {
        $slug = Str::slug($request->title, '-');

        $data = array();
        $data['title'] = $request->title;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = $request->status;
        $data['discount'] = $request->discount;

        if ($request->image) {
            if (File::exists($request->old_image)) {
                unlink($request->old_image);
            }
            $photo = $request->image;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(858, 476)->save('files/campaign/' . $photoname);
            $data['image'] = 'files/campaign/' . $photoname;

            DB::table('campaigns')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Campaign Successfully Updated');
        } else {
            $data['image'] = $request->old_image;

            DB::table('campaigns')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Campaign Successfully Updated');
        }
    }

        //Delete Campaign
    public function destroy($id)
    {
        $data = DB::table('campaigns')->where('id', $id)->first();
        $image = $data->image;
        if (File::exists($image)) {
            unlink($image);
        }

        DB::table('campaigns')->where('id', $id)->delete();

        return redirect()->back()->with('warning', 'Campaign Successfully Deleted');
    }


    // //Campaign Product All
    public function campaignProduct($campaign_id)
    {
        $products = DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')
                    ->leftJoin('subcategories', 'products.subcategory_id', 'subcategories.id')
                    ->leftJoin('brands', 'products.brand_id', 'brands.id')->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
                    ->where('products.status','1')
                    ->get();

            return view('admin.offer.campaign_product.index',compact('products','campaign_id'));
    }


    // Add Product To Campaign
    public function ProductAddToCampaign($campaign_id, $id)
    {

        $campaign = DB::table('campaigns')->where('id', $campaign_id)->first();
        $product = DB::table('products')->where('id', $id)->first();
        // dd($product, $campaign);
        // Discount Calculate
        $discount_amount = ($product->selling_price/100)*$campaign->discount;
        $discount_price = $product->selling_price-$discount_amount;

        $data=array();
        $data['product_id'] = $id;
        $data['campaign_id'] = $campaign_id;
        $data['price'] = $discount_price;
        DB::table('campaign_product')->insert($data);

        return redirect()->back()->with('success', 'Product Successfully Add To Campaign');
    }


    // Product List on Campaign
    public function ProductListCampaign($campaign_id)
    {
        $products = DB::table('campaign_product')->leftJoin('products', 'campaign_product.product_id', 'products.id')
                    ->select('products.name','products.code','products.thumbnail', 'campaign_product.*')
                    ->where('campaign_product.campaign_id', $campaign_id)
                    ->get();
        $campaign=DB::table('campaigns')->where('id',$campaign_id)->first();

        return view('admin.offer.campaign_product.campaign_product_list', compact('products', 'campaign'));
    }


    // Remove Product List on Campaign
    public function RemoveProduct($id)
    {
        DB::table('campaign_product')->where('id',$id)->delete();

        return redirect()->back()->with('error', 'Campaign Product Successfully Deleted!');
    }


}
