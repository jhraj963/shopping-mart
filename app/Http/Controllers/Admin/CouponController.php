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
                            <a href="#" data-id="' . $row->id . '" class="btn btn-danger btn-sm" id="delete_coupon">Delete <i class="fa-solid fa-delete-left"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.offer.coupon.index');
    }
}
