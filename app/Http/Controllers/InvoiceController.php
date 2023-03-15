<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('invoices')->join('customers','invoices.customer_id','=','customers.id')->select('invoices.id','customers.name','customers.address','invoices.description','invoices.date_created','invoices.amount')->get();

            return DataTables::of($data)
            ->addIndexColumn()
             //**************COSTOMER NAME COLUMN**********//
             ->addColumn('customer_name', function ($row) {
                $customer_name = $row->name;
                return $customer_name;
             })
            //************** END OF COSTOMER NAME COLUMN**********//
            //**************ADDRESS  COLUMN**********//
            ->addColumn('address', function ($row) {
                $address = $row->address;
                return $address;
             })
            //************** END OF ADDRESS  COLUMN**********//
            //**************DESCRIPTION  COLUMN**********//
            ->addColumn('description', function ($row) {
                $description = $row->description;
                return $description;
             })
            //************** END OF DESCRIPTION  COLUMN**********//
             //**************DATE  COLUMN**********//
             ->addColumn('date_created', function ($row) {
                $date_created = Carbon::parse($row->date_created)->format('Y-m-d H:m:i');
                return $date_created;
             })
            //************** END OF DATE  COLUMN**********//
             //**************AMOUNT  COLUMN**********//
             ->addColumn('amount', function ($row) {
                $amount ='R '.$row->amount;
                return $amount;
             })
            //************** END OF AMOUNT  COLUMN**********//
               //**************ACTION COLUMN**********//
               ->addColumn('action', function ($row) {
                $action = '<div class="btn-group">
                <a type="button" class="btn btn-sm btn-warning text-light">Edit</a>
                </div>';
                return $action;
            })
            //**********END ACTION COLUMN*********//
             ->rawColumns(['customer_name', 'address', 'description','date_created','amount','action'])
             ->make(true);
        }
    }
}
