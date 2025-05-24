<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
use App\Models\User;
use Image;

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

    // My Order
    public function MyOrder()
    {
        $orders=DB::table('orders')->where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('user.my_order',compact('orders'));
    }

    // Open Ticket
    public function Ticket()
    {
        $ticket=DB::table('tickets')->where('user_id', Auth::id())->latest()->take(10)->get();

        return view('user.ticket',compact('ticket'));
    }

    // Open Ticket
    public function NewTicket()
    {
        return view('user.new_ticket');
    }

    // Store Ticket
    public function StoreTicket(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required',
        ]);


        $data = array();
        $data['subject'] = $request->subject;
        $data['service'] = $request->service;
        $data['priority'] = $request->priority;
        $data['message'] = $request->message;
        $data['user_id'] = Auth::id();
        $data['status'] = 0;
        $data['date'] = date('Y-m-d');

        if($request->image){
            $photo = $request->image;
            $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
            // $photo->move('files/ticket/', $photoname); //without image intervention
            Image::make($photo)->resize(600, 360)->save('files/ticket/' . $photoname); //Image Intervention
            $data['image'] = 'files/ticket/' . $photoname;
        }

        DB::table('tickets')->insert($data);
        return redirect()->route('open.ticket')->with('success', 'Ticket Inserted Successfully.');
    }

    //Show Ticket
    public function ShowTicket($id)
    {
        $ticket = DB::table('tickets')->where('id', $id)->first();

        return view('user.show_ticket', compact('ticket'));
    }


    // Reply Ticket
    public function ReplyTicket(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required',
        ]);


        $data = array();
        $data['message'] = $request->message;
        $data['ticket_id'] = $request->ticket_id;
        $data['user_id'] = Auth::id();
        $data['reply_date'] = date('Y-m-d');

        if ($request->image) {
            $photo = $request->image;
            $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
            // $photo->move('files/ticket/', $photoname); //without image intervention
            Image::make($photo)->resize(600, 360)->save('files/ticket/' . $photoname); //Image Intervention
            $data['image'] = 'files/ticket/' . $photoname;
        }

        DB::table('replies')->insert($data);
        return redirect()->back()->with('success', 'Replied Done.');
    }
    

}
