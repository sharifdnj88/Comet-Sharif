<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    //  Admin Login System
    public function Login(Request $request)
    {
         // Validate 
         $this -> validate($request, [
            'email'         =>'required',
            'password'    =>'required'
         ]);

        //   Try To Login
        if( Auth::guard('admin') -> attempt([ 'email' => $request -> email, 'password' => $request -> password ]) || Auth::guard('admin') -> attempt([ 'mobile' => $request -> email, 'password' => $request -> password ]) ){
           
            if( Auth::guard('admin') -> User() -> status && Auth::guard('admin') -> User() -> trash == false  ){
                return redirect() -> route('admin.dashboard');
            }else{
                Auth::guard('admin') -> logout();
                return redirect() -> route('login.page') -> with('danger', 'Your account Suspend contact your Admin department');                
            }
           
        }else{
            return redirect() -> route('login.page') -> with('danger', 'Wrong Email or Password');
        }


    }

    //  Admin Logout
    public function logout()
    {
        Auth::guard('admin') -> logout();
        return redirect() -> route('login.page') -> with('success', 'Thanks for staying with us');
    }



}
