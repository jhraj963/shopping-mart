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
                          <a href="'.route('admin.ticket.show', [$row->id]).'" class="btn btn-info btn-sm  edit">Show <i class="fas fa-eye"></i></a>
                          <a href="'.route('admin.ticket.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete_ticket">Delete <i class="fa-solid fa-delete-left"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action', 'status', 'date'])
                ->make(true);
        }


        return view('admin.ticket.index');
    }

    //Show Ticket
    public function show($id)
    {
        $ticket=DB::table('tickets')->leftJoin('users', 'tickets.user_id', 'users.id')->select('tickets.*', 'users.name')->where('tickets.id',$id)->first();

        return view('admin.ticket.view_ticket',compact('ticket'));
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
        $data['user_id'] = 0;
        $data['reply_date'] = date('Y-m-d');

        if ($request->image) {
            $photo = $request->image;
            $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
            // $photo->move('files/ticket/', $photoname); //without image intervention
            Image::make($photo)->resize(600, 360)->save('files/ticket/' . $photoname); //Image Intervention
            $data['image'] = 'files/ticket/' . $photoname;
        }

        DB::table('replies')->insert($data);
        DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>1]);

        return redirect()->back()->with('success', 'Replied Done.');
    }

    //Close Ticket
    public function CloseTicket($id)
    {
        DB::table('tickets')->where('id', $id)->update(['status'=>2]);

        return redirect()->route('ticket.index')->with('success', 'Ticket Closed.');
    }


    // Destroy Ticket

    public function destroy($id)
    {
        DB::table('tickets')->where('id',$id)->delete();
        return response()->json('Ticket deleted!');
    }

}
