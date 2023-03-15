<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function verifylink($id,$token){
        $username = User::where('id',$id)->value('username');
        $dd = DB::table('password_reset_tokens')->where('username',$username)->orderBy('created_at', 'desc')->first();
        $db_token = $dd->token;
        if ($db_token != $token){
          return redirect()->route('forgot_password')->withErrors('Opps! Invaild link, request for new link');
        }
    
        if (!$token || !$username){
          return redirect()->route('login');
        }
    
        $db_time = $dd->created_at;
        $tk_date = Carbon::parse($db_time);
        $now = Carbon::now();
    
    
          if($tk_date->diffInMinutes($now) <= 5){
            return view('auth.resetpassword')->with([
                'token' => $token,
                'username'=>$username
                ]
            );
          }else{
              return redirect()->route('forgot_password')->withErrors('Ooops! link expired, request for new link');
          }
    }
    public function updatepassword(Request $request){
  
      $request->validate([
        'username' => 'required|email|exists:operators',
        'password' => ['required',
              'regex:/[a-z]/',      // must contain at least one lowercase letter
              'regex:/[A-Z]/',      // must contain at least one uppercase letter
              'regex:/[0-9]/',      // must contain at least one digit
              'regex:/[@$!%*#?&]/', // must contain a special character
              'min: 8',
              'confirmed'],
        'password_confirmation' => 'required',
  
    ]);
  
  
    $updatePassword = DB::table('password_reset_tokens')
                        ->where(['username' => $request->username, 'token' => $request->token])
                        ->first();
  
    if(!$updatePassword){
        return back()->withInput()->withErrors('Invalid token!');
    }
  
  
    $user = User::where('username', $request->username)
            ->update(['password' => Hash::make($request->password)]);
  
    return redirect('/')->with('success', 'Your password has been changed successfully!');
  
    }
}
