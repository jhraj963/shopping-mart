<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show All Category

     public function index()
    {
        // $data=DB::table('categories')->get(); //Query

        $data=Category::all(); // ORM
        return view('admin.category.category.index', compact('data'));
    }

    // Store Category

    public function store(Request $request)
    {


        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:60',
        ]);

        //Query
        // $data=array();
        // $data['category_name']=$request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->insert($data);

        //ORM
        Category::insert([
            'category_name'=> $request->category_name,
            'category_slug'=> Str::slug($request->category_name, '-'),
        ]);

        return redirect()->back()->with('success', 'Category Inserted');
     }


    // Edit Method

    public function edit($id)
    {
        // Query
        // $data=DB::table('categories')->where('id', $id)->first();

        //ORM
        $data=Category::findorfail($id);

        return response()->json($data);

    }

    // CategoryUpdate

    public function update(Request $request)
    {


        // Query
        // $data=array();
        // $data['category_name']=$request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->where('id', $request->id)->update($data);

        //ORM
        $category=Category::where('id', $request->id)->first();
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-'),
        ]);

        return redirect()->back()->with('success', 'Category Updated');
    }
    // Category Delete

    public function destroy($id)
    {
        //Query

        // DB::table('categories')->where('id', $id)->delete();

        //ORM
        $category=Category::find($id);
        $category->delete();

        return redirect()->back()->with('warning', 'Category Deleted');
    }



    // Child Category 

    public function GetChildCategory($id)
    {
        $data=DB::table('childcategories')->where('subcategory_id', $id)->get();

        return response()->json($data);
    }
}
