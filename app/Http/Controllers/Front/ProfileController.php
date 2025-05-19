<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function CustomerSetting()
    {
        return view('user.setting');
    }

    // Customer Change Password
    public function PasswordChange(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $current_password = Auth::user()->password;

        $oldpassword = $request->old_password;
        $new_password = $request->password;
        if (Hash::check($oldpassword, $current_password)) {
            $user = User::findorfail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->to('/')->with('success', 'Password Successfully Changed');
        } else {
            return redirect()->back()->with('error', 'Old Password Not Match');
        }
    }


}
