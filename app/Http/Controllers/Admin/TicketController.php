<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Image;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // All Tickets

    public function index(Request $request)
    {
        if ($request->ajax()) {


            $ticket = "";
            $query = DB::table('tickets')->leftJoin('users', 'tickets.user_id', 'users.id');

            if ($request->date) {
                $query->where('tickets.date', $request->date);
            }

            // Service
            if ($request->type=='Technical') {
                $query->where('tickets.service', $request->type);
            }
            if ($request->type=='Payment') {
                $query->where('tickets.service', $request->type);
            }
            if ($request->type=='Affiliate') {
                $query->where('tickets.service', $request->type);
            }
            if ($request->type=='Return') {
                $query->where('tickets.service', $request->type);
            }
            if ($request->type=='Refund') {
                $query->where('tickets.service', $request->type);
            }

            //Status
            if ($request->status == 1) {
                $query->where('tickets.status', 1);
            }

            if ($request->status == 2) {
                $query->where('tickets.status', 2);
            }

            if ($request->status == 0) {
                $query->where('tickets.status', 0);
            }

            $ticket = $query->select('tickets.*', 'users.name')->get();

            return DataTables::of($ticket)
                ->addIndexColumn()

                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge badge-warning">Running</span>';
                    } elseif ($row->status == 2) {
                        return '<span class="badge badge-muted">Closed</span>';
                    } else {
                        return '<span class="badge badge-danger">Pending</span>';
                    }
                })

                ->editColumn('date', function ($row) {
                   
                        return date('d F Y', strtotime($row->date));
                })

                ->addColumn('action', function ($row) {
                    $actionbtn = '
                          <a href="" class="btn btn-info btn-sm  edit">Show <i class="fas fa-eye"></i></a>
                          <a href="' . route('product.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete">Delete <i class="fa-solid fa-delete-left"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action', 'status', 'date'])
                ->make(true);
        }


        return view('admin.ticket.index');
    }
}
