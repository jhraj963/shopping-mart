<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Image;
use File;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show All Category

    public function index()
    {
        $data=DB::table('blog_category')->get(); //Query
        return view('admin.blog.category', compact('data'));
    }

    // store Category
    public function store(Request $request)
    {


        $validated = $request->validate([
            'category_name' => 'required|max:60',
        ]);

        //Query
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        DB::table('blog_category')->insert($data);

        return redirect()->back()->with('success', 'Blog Category Inserted');
    }


    // Edit Method

    public function edit($id)
    {
        // Query
        $data=DB::table('blog_category')->where('id', $id)->first();

        return view('admin.blog.category_edit', compact('data'));
    }


    // Blog Category Update

    public function update(Request $request)
    {


        // Query
        $slug = Str::slug($request->category_name, '-');
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        DB::table('blog_category')->where('id', $request->id)->update($data);

        return redirect()->back()->with('success', 'Blog Category Updated');
    }


    // Delete 
    public function destroy($id)
    {
        //Query

        DB::table('blog_category')->where('id', $id)->delete();

        return redirect()->back()->with('warning', 'Blog Category Successfully Deleted');
    }

}
