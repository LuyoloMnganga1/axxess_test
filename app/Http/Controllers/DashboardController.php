<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\customers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        $operators = User::all()->count();
        $customers = customers::all()->count();
        return view('index')->with(
            [
                'operators'=>$operators,
                'customers'=>$customers,
            ]);
    }
    public function profile(){
        $data = User::where('username',Auth::user()->username)->first();
        return view('user.profile')->with('data',$data);
    }
    public function updateprofile(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => ['required','email'],
            'name'=>['required','string'],
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
          }
        
        $user =  User::where('id',Auth::user()->id)->update(['username'=>$request->username,'name'=>$request->name]);

        return redirect()->back()->with('success','Profile updated successfuly');
    }
}
