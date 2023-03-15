<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function index(){
        return view('auth.forgotpassword');
    }
    public function forgotpassword(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|email|exists:operators',
        ]);
        if ($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput();
        }
        //token
        $token = Str::random(25);
        //find user on password_reset_tokens table 
        $user = DB::table('password_reset_tokens')->where('username',$request->username)->first();
        if(!$user){
            DB::table('password_reset_tokens')->insert(
                [
                    'username' => $request->username,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]
            );
        }else{
            DB::table('password_reset_tokens')->where('username',$request->username,)->update(
                [
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]
            );
        }
        
        //user id
        $id = User::where('username',$request->username)->value('id');
        //send email to user
        Mail::to($request->username)->send(new ForgotPassword($id,$token));
        return redirect()->back()->with('success', 'A fresh verification link has been sent to your email address!');
    }
}
