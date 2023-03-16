<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\payments;
use App\Models\invoices;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
             ->rawColumns(['name', 'address','date_created','username','balance'])
             ->make(true);
        }
    }
    public function payment(Request $request){
         $validator = Validator::make($request->all(), [
            'amount'=>['required','numeric'],
        ]);
   
        if ($validator->fails()){
         return redirect()->back()->withErrors($validator)->withInput();
       }
       $invoice_amount = invoices::where('id',$request->invoice_id)->value('amount');
       $payment_amount = $request->amount;
       $balance = (float)  $invoice_amount - (float) $payment_amount;
       $invoice = invoices::where('id',$request->invoice_id)->update(['amount'=> $balance]);
       payments::create([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
       ]);
       return redirect()->back()->with('success', 'Payment has been created successfully.');
    }
}
