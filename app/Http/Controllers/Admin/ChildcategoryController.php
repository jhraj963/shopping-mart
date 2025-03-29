<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;

class ChildcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
                $data=DB::table('childcategories')->leftJoin('categories', 'childcategories.category_id', 'categories.id')->leftJoin('subcategories', 'childcategories.subcategory_id', 'subcategories.id')->select('categories.category_name', 'subcategories.subcategory_name', 'childcategories.*')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
$actionbtn='<a href="" class="btn btn-info btn-sm  edit" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal">Edit <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="" class="btn btn-danger btn-sm" id="delete">Delete <i class="fa-solid fa-delete-left"></i></a>';

                        return $actionbtn;
                  })
                        ->rawColumns(['action'])
                        ->make(true);


        }
            $category=DB::table('categories')->get();
            return view('admin.category.childcategory.index',compact('category'));
    }

        public function store(Request $request){
            $categ=DB::table('subcategories')->where('id',$request->subcategory_id)->first();

            $data=array();
            $data['category_id']=$categ->category_id;
            $data['subcategory_id']=$request->subcategory_id;
            $data['childcategory_name']= $request->childcategory_name;
            $data['childcategory_slug']= Str::slug($request->childcategory_name, '-');

            DB::table('childcategories')->insert($data);
            return redirect()->back()->with('success', 'Child Category Inserted Successfully.');
        }
}
