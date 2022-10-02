<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use App\Notifications\AdminForgotPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminForgotPasswordController extends Controller
{
     // Management Forgot Page View
     public function ShowForgotPassword()
     {
         return view('forgot.forgot');
     }
 
     public function ForgotPassword(Request $request)
     {
         $this -> validate($request, [
             'email'     =>'required|email'
         ]);
 
         $manage_data = admin::where('email', $request -> email) -> first();
 
         if( $manage_data ){
             $token = md5( time(). rand() );
             $manage_data ->update([
                 'access_token'  => $token
             ]);
             $manage_data ->notify(new AdminForgotPasswordNotification($manage_data));
             return redirect() -> route('login.page') -> with('success', 'Please check your email & Click the Link'); 
         }else{
             return back() -> with('danger', 'We can not find your email. Please enter your valid email');
         }
 
 
 
     }
 
     //  Reset Password Link
     public function ResetPasswordLink($token =null, $email =null)
     {
         if( !$token && !$email ){
             return redirect() -> route('login.page') -> with('danger', 'Acces token or Email not found');
         }
         
         if( $token && $email ){
             $manage_data = admin::where('access_token', $token) -> first();
             $manag_data_email = admin::where('email', $email) -> first();
 
             if( $manage_data && $manag_data_email  ){
                 return view('forgot.reset', compact('email'));
 
             }else{
                 return redirect() -> route('login.page') -> with('danger', 'Acces token or Email not match');
             }
 
         }
 
     }
 
     public function ResetPassword(Request $request)
     {
         $this -> validate($request, [
             'password'    =>'required|confirmed'
         ]);
 
         $manage_data = admin::where('email', $request -> email) -> first();
 
         if( $manage_data ){
             $manage_data ->update([
                 'access_token'  => null,
                 'password'      => Hash::make( $request -> password )
             ]);
             return redirect() -> route('login.page') -> with('success', 'Your Forgot Password Successfully Change'); 
         }
 
          
 
 
     }





}
