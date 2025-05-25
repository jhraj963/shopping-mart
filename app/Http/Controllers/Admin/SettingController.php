<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //seo page show

    public function seo()
    {
        $data=DB::table('seos')->first();
        return view('admin.setting.seo', compact('data'));
    }

    //seo update

    public function update(Request $request, $id)
    {
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_description']=$request->meta_description;
        $data['meta_keyword']=$request->meta_keyword;
        $data['alexa_verification']=$request->alexa_verification;
        $data['google_verification']=$request->google_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;

        DB::table('seos')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'SEO Setting Updated');
    }


    // smtp setting

    public function smtp()
    {
        $smtp=DB::table('smtp')->first();
        return view('admin.setting.smtp', compact('smtp'));
    }

    // smtp Update


    public function smtpUpdate(Request $request, $id)
    {
        $data = array();
        $data['mailer'] = $request->mailer;
        $data['host'] = $request->host;
        $data['port'] = $request->port;
        $data['user_name'] = $request->user_name;
        $data['password'] = $request->password;

        DB::table('smtp')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'SMTP Setting Updated');
    }



    //Website Setting

    public function website()
    {
        $setting=DB::table('settings')->first();
        return view('admin.setting.website', compact('setting'));
    }

    // Website Update

    public function websiteUpdate(Request $request, $id)
    {
        $data=array();
        $data['currency']=$request->currency;
        $data['phone_one']=$request->phone_one;
        $data['phone_two']=$request->phone_two;
        $data['main_email']=$request->main_email;
        $data['support_email']=$request->support_email;
        $data['address']=$request->address;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['instagram']=$request->instagram;
        $data['linkedin']=$request->linkedin;
        $data['youtube']=$request->youtube;

        //logo
            if($request->logo){
                $logo = $request->logo;
                $logoname = uniqid() . '.' . $logo->getClientOriginalExtension();
                $logo->move('files/setting/', $logoname);

                $data['logo'] = 'files/setting/' . $logoname;
            }else{
                $data['logo'] = $request->old_logo;
            }

        //favicon
            if($request->favicon){
                $favicon = $request->favicon;
                $faviconname = uniqid() . '.' . $photo->getClientOriginalExtension();
                $favicon->move('files/setting/', $faviconname);

                $data['favicon'] = 'files/setting/' . $faviconname;
            }else{
                $data['favicon'] = $request->old_favicon;
            }

            DB::table('settings')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Website Setting Updated');

    }


    // Payment Gateway
    public function PaymentGateway()
    {
        $aamarpay=DB::table('payment_gateway_bd')->first();
        $surjopay=DB::table('payment_gateway_bd')->skip(1)->first();
        $ssl=DB::table('payment_gateway_bd')->skip(2)->first();

        return view('admin.bdpayment_gateway.edit',compact('aamarpay','surjopay','ssl'));
    }

    // AamarPay Update

    public function AamarpayUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        return redirect()->back()->with('success', 'AamarPay Payment Gateway Updated');
    }

    // Surjopay Update

    public function SurjopayUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        return redirect()->back()->with('success', 'Surjopay Payment Gateway Updated');
    }

    // SSLCOMMERZ Update

    public function SslUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        return redirect()->back()->with('success', 'SSLCOMMERZ Payment Gateway Updated');
    }

}
