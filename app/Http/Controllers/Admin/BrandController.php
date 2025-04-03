<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
// use Image;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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
                            <a href="' . route('brand.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete">Delete <i class="fa-solid fa-delete-left"></i></a>';

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
        $data['brand_logo']= 'files/brand/'.$photoname;


        DB::table('brands')->insert($data);
        return redirect()->back()->with('success', 'Brand Inserted Successfully.');
    }

    public function edit($id)
    {

        $data = DB::table('brands')->where('id', $id)->first();


        return view('admin.category.brand.edit', compact('data'));
    }

    // Brand Update

    public function update(Request $request)
    {
        $slug = Str::slug($request->brand_name, '-');

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        if($request->brand_logo){
            if(File::exists($request->old_logo)){
                unlink($request->old_logo);
        }
            $photo = $request->brand_logo;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            $photo->move('files/brand/', $photoname);
            $data['brand_logo'] = 'files/brand/' . $photoname;

            DB::table('brands')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Brand Updated');
        }else{
            $data['brand_logo'] = $request->old_logo;

            DB::table('brands')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Brand Updated');
        }


    }


    // Brand Delete

    public function destroy($id)
    {
        $data=DB::table('brands')->where('id', $id)->first();
            $image=$data->brand_logo;
                if(File::exists($image)){
                unlink($image);
                }

        DB::table('brands')->where('id', $id)->delete();

        return redirect()->back()->with('warning', 'Brand Deleted');
    }
}
