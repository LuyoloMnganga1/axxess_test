<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\payments;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class PaymentsController extends Controller
{
    public function index(Request $request){
          
        if($request->ajax()){
            $data = payments::join('customers','payments.customer_id','=','customers.id')->select('payments.id','payments.customer_id','payments.date_created','payments.amount','customers.name')
                                ->latest('payments.created_at')->get();
            return DataTables::of($data)
            ->addIndexColumn()
             //**************COSTOMER NAME COLUMN**********//
             ->addColumn('name', function ($row) {
                $name = $row->name;
                return $name;
             })
            //************** END OF COSTOMER NAME COLUMN**********//
             //**************DATE  COLUMN**********//
             ->addColumn('date_created', function ($row) {
                $date_created = Carbon::parse($row->date_created)->format('Y-m-d H:m:i');
                return $date_created;
             })
            //************** END OF DATE  COLUMN**********//
             //**************AMOUNT COLUMN**********//
             ->addColumn('amount', function ($row) {
                $amount ='R '.$row->amount;
                return $amount;
             })
            //************** END OF AMOUNT COLUMN**********//
               //**************ACTION COLUMN**********//
               ->addColumn('action', function ($row) {
                $action = '<div class="btn-group">
                <a type="button" class="btn btn-sm btn-warning text-light"  id="edit">Edit</a>
                <a type="button" class="btn btn-sm btn-danger text-light" id ="delete" >Delete</a>
                </div>';
                return $action;
            })
            //**********END ACTION COLUMN*********//
             ->rawColumns(['name', 'address','date_created','username','balance','action'])
             ->make(true);
        }
    }
}
