<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show All Sub Category

    public function index()
    {
        //Query
        $data=DB::table('subcategories')->leftJoin('categories', 'subcategories.category_id', 'categories.id')
        ->select('subcategories.*', 'categories.category_name')->get();
        // $category=Category::all();

        //ORM

        $category=DB::table('categories')->get();

        return view('admin.category.subcategory.index', compact('data', 'category'));
    }

    //Insert SubCategory
    public function store(Request $request)
    {


        $validated = $request->validate([
            'subcategory_name' => 'required||max:60',
        ]);

        //Query
        // $data=array();
        // $data['category_id']=$request->category_id;
        // $data['subcategory_name']=$request->subcategory_name;
        // $data['subcategory_slug'] = Str::slug($request->subcategory_name, '-');
        // DB::table('subcategories')->insert($data);

        //ORM
        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
        ]);

        return redirect()->back()->with('success', 'Sub Category Inserted');
    }

    // Edit Method

    public function edit($id)
    {
        // Query
        $data=Subcategory::find($id);
        $category=DB::table('categories')->get();

        //ORM
        // $data = Subcategory::find($id);
        // $category = Category::all();

        return view('admin.category.subcategory.edit', compact('data', 'category'));
    }

    // Sub CategoryUpdate

    public function update(Request $request)
    {


        // Query
        // $data=array();
        // $data['category_id']=$request->category_id;
        // $data['subcategory_name']=$request->subcategory_name;
        // $data['subcategory_slug'] = Str::slug($request->subcategory_name, '-');
        // DB::table('subcategories')->where('id', $request->id)->update($data);

        //ORM
        $subcategory = Subcategory::where('id', $request->id)->first();
        $subcategory->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
        ]);

        return redirect()->back()->with('success', 'Sub Category Updated');
    }

    // Sub Category Delete

    public function destroy($id)
    {
        //Query

        // DB::table('subcategories')->where('id', $id)->delete();

        //ORM
        $subcategory = Subcategory::find($id);
        $subcategory->delete();

        return redirect()->back()->with('warning', 'Sub Category Deleted');
    }

}
