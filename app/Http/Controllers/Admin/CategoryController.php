<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use Illuminate\Support\Str;
use Image;
use File;

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
            'icon' => 'required',
        ]);

        //Query
        // $data=array();
        // $data['category_name']=$request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->insert($data);

        $photo = $request->icon;
        $slug = Str::slug($request->category_name, '-');
        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(32, 32)->save('files/category/' . $photoname); //Image Intervention

        //ORM
        Category::insert([
            'category_name'=> $request->category_name,
            'category_slug'=> Str::slug($request->category_name, '-'),
            'home_page' => $request->home_page,
            'icon' => 'files/category/' . $photoname,
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

        // return response()->json($data);
        return view('admin.category.category.edit', compact('data'));

    }

    // CategoryUpdate

    public function update(Request $request)
    {


        // Query
        // $data=array();
        // $data['category_name']=$request->category_name;
        // $data['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->where('id', $request->id)->update($data);

        $slug = Str::slug($request->category_name, '-');

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = $slug;
        $data['home_page'] = $request->home_page;
        if ($request->icon) {
            if (File::exists($request->old_icon)) {
                unlink($request->old_icon);
            }
            $photo = $request->icon;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(32, 32)->save('files/category/' . $photoname); //Image Intervention
            $data['icon'] = 'files/category/' . $photoname;

            DB::table('categories')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Category Updated');
        } else {
            $data['icon'] = $request->old_icon;

            DB::table('categories')->where('id', $request->id)->update($data);

            return redirect()->back()->with('success', 'Category Updated');
        }

        return redirect()->back()->with('success', 'Category Updated');
    }

    // Category Delete

    public function destroy($id)
    {
        //Query

        // DB::table('categories')->where('id', $id)->delete();

        //ORM
        // $category=Category::find($id);
        // $category->delete();

        $data = DB::table('categories')->where('id', $id)->first();
        $image = $data->icon;
        if (File::exists($image)) {
            unlink($image);
        }

        DB::table('categories')->where('id', $id)->delete();

        return redirect()->back()->with('warning', 'Category Successfully Deleted');
    }



    // Child Category

    public function GetChildCategory($id)
    {
        $data=DB::table('childcategories')->where('subcategory_id', $id)->get();

        return response()->json($data);
    }
}
