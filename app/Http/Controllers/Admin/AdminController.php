<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function admin()
    {
        return view('admin.home');
    }

    // Admin logout
   public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login')->with('error', 'Admin Logout');
    }

}
