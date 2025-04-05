<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('coupons')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="" class="btn btn-info btn-sm  edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal">Edit <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="' . route('coupon.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete_coupon">Delete <i class="fa-solid fa-delete-left"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.offer.coupon.index');
    }

        //store coupon
    public function store(Request $request)
    {
        $data=array(
            'coupon_code'=>$request->coupon_code,
            'type'=>$request->type,
            'valid_date'=>$request->valid_date,
            'coupon_amount'=>$request->coupon_amount,
            'status'=>$request->status,
        );
        DB::table('coupons')->insert($data);
        return response()->json('Coupon Successfully Inserted!');
    }

    //Edit Coupon

    public function edit($id)
    {
        $data=DB::table('coupons')->where('id', $id)->first();
        return view ('admin.offer.coupon.edit', compact('data'));
    }

    // Coupon Update
    public function update(Request $request)
    {
        $data=array(
            'coupon_code'=>$request->coupon_code,
            'type'=>$request->type,
            'valid_date'=>$request->valid_date,
            'coupon_amount'=>$request->coupon_amount,
            'status'=>$request->status,
        );
        DB::table('coupons')->where('id', $request->id)->update($data);
        return response()->json('Coupon Successfully Updated!');
        // return redirect()->back()->with('warning', 'Coupon Successfully Updated!');
    }

    //delete coupon

    public function destroy($id)
    {
        DB::table('coupons')->where('id', $id)->delete();

        return response()->json('Coupon deleted!');
    }
}
