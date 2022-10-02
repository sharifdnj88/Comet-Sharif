<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
     // Admin Profile Page Show
     public function ShowAdminProfile()
     {
         return view('admin.layouts.profile');
     }

    /**
     * Admin Profile Change 
     */
    public function AdminProfileChange(Request $request)
    {
        // Patient Photo Upload

        if( $request -> hasFile('photo') ){

            $img = $request -> file('photo');
            $file_name = md5( time(). rand() ) . '.' . $img -> clientExtension();
            $img -> move( storage_path('app/public/admins/'), $file_name );

        }else{
            $file_name = 'avatar.png';
        }

        $update_data = admin::findOrFail( Auth::guard('admin') -> User() -> id );
        $update_data -> update([           
            'first_name'        => $request -> first_name,
            'last_name'        => $request -> last_name,
            'dob'                => $request -> dob,
            'email'              => $request -> email,
            'mobile'             => $request -> mobile,
            'address'            => $request -> address,
            'city'                 => $request -> city,
            'zip_code'           => $request -> zip_code,
            'country'            => $request -> country,
            'photo'             => $file_name,
        ]);
        return back() -> with('success', 'Your Profile Data Update Successfully');


    }

    /**
     * Admin Password Change
     */
    public function AdminPasswordChange(Request $request)
    {
        // Validate
        $this -> validate($request, [
            'old_pass'          =>'required',
            'pass'               =>'required|confirmed'
        ]);

        // Old Password Check
        if( !password_verify( $request -> old_pass, Auth::guard('admin') -> User() -> password ) ){
            return back() -> with('danger', 'Old Password dose not match');
        }

        // Conformation Password Check
        if( $request -> pass != $request -> pass_confirmation ){
            return back() -> with('danger', 'Confirmation password not match');
        }

        // Password Change
        $data = admin::findOrFail( Auth::guard('admin') -> User() -> id );
        $data ->update([
            'password'      => Hash::make( $request -> pass )
        ]);

        Auth::guard('admin') -> logout();
        return redirect() -> route('login.page') -> with('success', 'Your Profile Password Change Successfully');

    }


}
