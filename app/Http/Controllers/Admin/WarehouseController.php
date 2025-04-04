<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show Warehouse

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('warehouses')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="" class="btn btn-info btn-sm  edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal">Edit <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="' . route('warehouse.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete">Delete <i class="fa-solid fa-delete-left"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $category = DB::table('categories')->get();
        return view('admin.category.warehouse.index');
    }


    // store warehouse

    public function store(Request $request)
    {
          $validated = $request->validate([
            'warehouse_name' => 'required|unique:warehouses',
        ]);

        $data=array();
        $data['warehouse_name']=$request->warehouse_name;
        $data['warehouse_address']=$request->warehouse_address;
        $data['warehouse_phone']=$request->warehouse_phone;
        DB::table('warehouses')->insert($data);
        return redirect()->back()->with('success', 'WareHouse Inserted Successfully.');
    }


    // edit warehouse

    public function edit($id)
    {
        $data=DB::table('warehouses')->where('id', $id)->first();
        return view('admin.category.warehouse.edit', compact('data'));
    }

    // update warehouse

    public function update(Request $request)
    {
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone'] = $request->warehouse_phone;
        DB::table('warehouses')->where('id', $request->id)->update($data);

        return redirect()->back()->with('success', 'WareHouse Updated Successfully.');
    }


    // delete Warehouse

    public function destroy($id)
    {
        DB::table('warehouses')->where('id', $id)->delete();

        return redirect()->back()->with('warning', 'WareHouse Deleted');
    }
}
