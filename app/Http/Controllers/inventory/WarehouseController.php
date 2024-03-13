<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{
    public function index(){
        $data=[
            'title' => 'Warehouses',
        ];

        return view('inventory.warehouse',$data);
    }

    public function fetch_data(){

        $warehouse_data=Warehouse::orderBy('id', 'desc')->get();

        if (request()->ajax()) {
            return DataTables::of($warehouse_data)
            ->addColumn('action',function($row){
                return '<a href="javascript:void(0)" class="btn btn-info editButton" data-id="'.$row->id.'">Edit</a> 
                <a href="javascript:void(0)" class="btn btn-danger deleteButton" data-id="'.$row->id.'">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function store(Request $request){
        

        $warehouseId=$request->input('warehouseId');
        $warehouse= Warehouse::find($warehouseId);

        if(!$warehouse){

            $validated=Validator::make($request->all(), [
                'name' => 'required|unique:warehouses,name,NULL,id,deleted_at,NULL|max:255',
                'address' => 'required',
            ]);

            $warehouse=new Warehouse(); 
            $message= 'Form submitted successfully';

        }else{
            $validated=Validator::make($request->all(), [
                'name' => 'required|unique:warehouses,name,' . $warehouseId . ',id,deleted_at,NULL',
                'address' => 'required',
            ]);

            $message= 'Form Updated successfully';
        }

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()->all()], 422);
        }

            $warehouse->name= $request->input('name');
            $warehouse->address= $request->input('address');
            $warehouse->save();

            return response()->json(['message' => $message]);

    }

    public function show($id){

        $warehouse= new Warehouse;
        $warehouseData= $warehouse->find($id);

        return response()->json(['data'=>$warehouseData]);

    }

    public function delete($id){
        $warehouse= new Warehouse;
        $warehouse->find($id)->delete();
        return response()->json("deleted successfully");
    }
}
