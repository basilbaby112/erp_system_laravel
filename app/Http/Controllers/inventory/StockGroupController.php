<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\StockGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockGroupController extends Controller
{
    public function index(){

        $data=[
            'title' => 'Stock Group',
        ];

        return view('inventory.stock_groups',$data);
    }

    public function fetch_data(){

        $warehouse_data=StockGroup::orderBy('id', 'desc')->get();

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
}
