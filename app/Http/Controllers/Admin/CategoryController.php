<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;

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
}
