<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

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

    //Password Change

    public function passwordChange()
    {
        return view('admin.profile.password_change');

        // return redirect()->route('admin.login')->with('error', 'Admin Logout');
    }

    //Password Update

    public function passwordUpdate(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $current_password=Auth::user()->password;

        $oldpassword=$request->old_password;
        $new_password=$request->password;
        if(Hash::check($oldpassword, $current_password)){
            $user=User::findorfail(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('admin.login')->with('success', 'Admin Password Successfully Changed');
        }else{
                    return redirect()->back()->with('error', 'Old Password Not Match');
        }
    }
}
