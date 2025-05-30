<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;
use Mail;
use App\Mail\ReceivedMail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //All Order List
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imgurl = 'files/product';

            $product = "";
            $query = DB::table('orders')->orderBy('id','DESC');

            // if ($request->category_id) {
            //     $query->where('products.category_id', $request->category_id);
            // }

            if ($request->payment_type) {
                $query->where('payment_type', $request->payment_type);
            }

            if ($request->date) {
                $order_date=date('d-m-Y',strtotime($request->date));
                $query->where('date',$order_date);
            }

            if ($request->status == 0) {
                $query->where('status', 0);
            }

            if ($request->status == 1) {
                $query->where('status', 1);
            }

            if ($request->status == 2) {
                $query->where('status', 2);
            }

            if ($request->status == 3) {
                $query->where('status', 3);
            }

            if ($request->status == 4) {
                $query->where('status', 4);
            }

            if ($request->status == 5) {
                $query->where('status', 5);
            }

            $product = $query->get();

            return DataTables::of($product)
                ->addIndexColumn()

                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<span class="badge badge-danger">Pending</span>';
                    } elseif($row->status == 1) {
                        return '<span class="badge badge-primary">Received</span>';
                    } elseif ($row->status == 2) {
                        return '<span class="badge badge-info">Shipped</span>';
                    } elseif ($row->status == 3) {
                        return '<span class="badge badge-success">Completed</span>';
                    } elseif ($row->status == 4) {
                        return '<span class="badge badge-warning">Return</span>';
                    } elseif ($row->status == 5) {
                        return '<span class="badge badge-danger">Cancel</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" data-id="' . $row->id . '" class="btn btn-primary btn-sm  edit" data-toggle="modal" data-target="#editModal">Edit <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="" class="btn btn-info btn-sm  edit">Show <i class="fas fa-eye"></i></a>
                            <a href="' . route('product.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete">Delete <i class="fa-solid fa-delete-left"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }


        return view('admin.order.index');
    }

    //Order Edit
    public function edit($id)
    {
        $order=DB::table('orders')->where('id',$id)->first();
        return view('admin.order.edit',compact('order'));
    }


    // Update Order Status

    public function update(Request $request)
    {
        $data=array();
        $data['c_name']=$request->c_name;
        $data['c_email']=$request->c_email;
        $data['c_address']=$request->c_address;
        $data['c_phone']=$request->c_phone;
        $data['status']=$request->status;

        if($request->status=='1'){
            Mail::to($request->c_email)->send(new ReceivedMail($data));
        }

        DB::table('orders')->where('id',$request->id)->update($data);

        return response()->json('Successfully Changed Status');
    }

}
