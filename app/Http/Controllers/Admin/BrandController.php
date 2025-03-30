<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
// use Image;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Show All Brand
    public function index(Request $request){
        if ($request->ajax()) {
            $data = DB::table('brands')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="" class="btn btn-info btn-sm  edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal">Edit <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="' . route('childcategory.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete">Delete <i class="fa-solid fa-delete-left"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.category.brand.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:60',
        ]);

        $slug= Str::slug($request->brand_name, '-');

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
            $photo=$request->brand_logo;
            $photoname=$slug.'.'.$photo->getClientOriginalExtension();
            $photo->move('files/brand/',$photoname); //without image intervention
            // Image::make($photo)->resize(240,120)->save('public/files/brand/', $photoname); //Image Intervention
            $data['brand_logo']= 'public/files/brand/'.$photoname;


        DB::table('brands')->insert($data);
        return redirect()->back()->with('success', 'Brand Inserted Successfully.');
    }
}
