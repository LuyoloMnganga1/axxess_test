<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customers;
use App\Models\invoices;
use App\Models\invoice_lines;
use App\Models\payments;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CostomerController extends Controller
{
    public function index(Request $request){
        
        if($request->ajax()){
            $data = customers::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
             //**************COSTOMER NAME COLUMN**********//
             ->addColumn('name', function ($row) {
                $name = $row->name;
                return $name;
             })
            //************** END OF COSTOMER NAME COLUMN**********//
            //**************ADDRESS  COLUMN**********//
            ->addColumn('address', function ($row) {
                $address = $row->address;
                return $address;
             })
            //************** END OF ADDRESS  COLUMN**********//
             //**************USERNAME  COLUMN**********//
             ->addColumn('username', function ($row) {
                $username = $row->username;
                return $username;
             })
            //************** END OF USERNAME  COLUMN**********//
             //**************BALANCE  COLUMN**********//
             ->addColumn('balance', function ($row) {
                $balance ='R '.$row->balance;
                return $balance;
             })
            //************** END OF BALANCE  COLUMN**********//
               //**************ACTION COLUMN**********//
               ->addColumn('action', function ($row) {
                $action = '<div class="btn-group">
                <a type="button" class="btn btn-sm btn-info text-light" data-href="/find-customer/'.$row->username.'" id="view">View</a>
                <a type="button" class="btn btn-sm btn-warning text-light" data-href="/find-customer/'.$row->username.'" id="edit">Edit</a>
                <a type="button" class="btn btn-sm btn-danger text-light" id ="delete"  data-href="/delete-customer/'.$row->id.'">Delete</a>
                </div>';
                return $action;
            })
            //**********END ACTION COLUMN*********//
             ->rawColumns(['name', 'address','username','balance','action'])
             ->make(true);
        }
        return view('costomers.index');
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => ['required','email','unique:customers'],
            'name'=>['required','string'],
            'address'=>['required','string'],
            'balance'=>['required','numeric'],
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
          }
          customers::create([
            'name' => $request->name,
            'address' => $request->address,
            'username' => $request->username,
            'balance' => $request->balance,
            'password' => Hash::make('welcome'),
          ]);
          return redirect()->back()->with('success', 'Customer created successfully.');
    }
    public function update(Request $request){
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'username' => ['required','email','unique:customers,username,'.$id],
            'name'=>['required','string'],
            'address'=>['required','string'],
            'balance'=>['required','numeric'],
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
          }
          customers::where('id',$id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'username' => $request->username,
            'balance' => $request->balance,
          ]);
          return redirect()->back()->with('success', 'Customer updated successfully.');
    }
    public function delete($id){
        customers::where('id', $id)->delete();
        $customer_invoice_id = invoices::where('customer_id',$id)->pluck('id')->toArray();
        invoices::where('customer_id',$id)->delete();
        foreach($customer_invoice_id as $invoice_id){
            invoice_lines::where('invoice_id',$invoice_id)->delete();
        }
        $payment_id = payments::where('customer_id',$id)->delete();
       
        return redirect()->back()->with('success', 'Customer deleted successfully.');
    }
    public function findcustomer($username){
        $customer = customers::where('username',$username)->first();
       return response()->json($customer);
    }
    public function allcustomers(){
        $customers = customers::orderBy('name','asc')->get();
        return response()->json($customers);
    }
}
