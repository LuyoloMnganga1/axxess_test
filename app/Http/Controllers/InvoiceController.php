<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\invoices;
use App\Models\invoice_lines;
use App\Models\payments;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('invoices')->join('customers','invoices.customer_id','=','customers.id')->select('invoices.id','customers.name','customers.address','invoices.customer_id','invoices.description','invoices.date_created','invoices.amount')->get();

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
               $new_amount =  number_format((float)$row->amount , 2, '.', ''); 
                $amount ='R '.$new_amount;
                return $amount;
             })
            //************** END OF AMOUNT  COLUMN**********//
               //**************ACTION COLUMN**********//
               ->addColumn('action', function ($row) {
                $action = '<div class="btn-group">
                <a type="button" class="btn btn-sm btn-info text-light" id="view" data-href="/view-invoice/'.$row->id.'">View</a>
                <a type="button" class="btn btn-sm btn-secondary text-light" id="pay" data-href="/view-invoice/'.$row->id.'">Pay</a>
                </div>';
                return $action;
            })
            //**********END ACTION COLUMN*********//
             ->rawColumns(['customer_name', 'address', 'description','date_created','amount','action'])
             ->make(true);
        }
    }
    public function show($id){
      $invoices = invoices::join('customers','invoices.customer_id','=','customers.id')->select('invoices.*','customers.name')->where('invoices.id',$id)->first();
      $invoice_lines = invoice_lines::where('invoice_id',$id)->get();
      return response()->json([
          'invoice' => $invoices,
          'invoice_lines' => $invoice_lines
      ]);
    }
    public function store(Request $request){
      $validator = Validator::make($request->all(), [
         'customer_id' => ['required'],
         'invoice_subject'=>['required','string'],
         'invoice_line'=>['required','string'],
         'invoice_line_amount'=>['required','numeric'],
     ]);

     if ($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput();
    }
    $lines = (int)$request->line_number;
    $amount  =(float) $request->invoice_line_amount;
    for ($x = 2; $x <= $lines; $x++) {
         $amount  = $amount + (float) $request->invoice_line_amount.$x;
    }
    $amount =  number_format((float)$amount , 2, '.', ''); 
     $invoice = invoices::create(
         [
             'customer_id' => $request->customer_id,
             'description' => $request->invoice_subject,
             'amount'=> $amount,
         ]
     );
     $lines = (int)$request->line_number;
     $invoice_lines = invoice_lines::create(
      [
         'invoice_id' => $invoice->id,
         'description' => $request->invoice_line,
         'amount' => $request->invoice_line_amount,
      ]
   );
      for ($x = 2; $x <= $lines; $x++) {
            $invoice_lines = invoice_lines::create(
               [
                  'invoice_id' => $invoice->id,
                  'description' => $request['invoice_line'.$x],
                  'amount' =>$request['invoice_line_amount'.$x],
               ]
            );
         }
         return redirect()->back()->with('success','Invoive created successfully');
   }
    
}
