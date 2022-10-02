<?php

namespace App\Http\Controllers\Admin;

use App\Models\role;
use App\Models\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AccoountInformationNotification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_admin = admin::latest() -> where('trash', false) -> get();
        $roles = role::latest() -> get();
        return view('pages.user.index', [
            'all_admin'         =>$all_admin,
            'form_type'         => 'create',
            'roles'                => $roles

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $this ->validate($request, [
            'name'      => 'required',
            'email'      => 'required|email|unique:admins',
            'mobile'    => 'required|unique:admins',
            'role'        => 'required'
        ]);

         

        //  Password Generate
         $pass_string = str_shuffle('qwertyuiopasdfghjklzxcvbnm+-*1234567890');

         $pass_short = substr($pass_string, 10,10);

        $user = admin::create([
            'role_id'           => $request -> role,
            'name'             => $request -> name,
            'email'             => $request -> email,
            'mobile'            => $request ->mobile,
            'password'         => Hash::make( $pass_short )
        ]);
        $user ->notify(new AccoountInformationNotification($user, $pass_short));
        return back() -> with('success', 'Admin Create add Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = admin::latest() -> get();
        $user = admin::findOrFail($id);
        $role = role::latest() -> get();

        return view('pages.user.index', [
            'all_admin'     => $admin,
            'edit'           => $user,
            'roles'          => $role,
            'form_type'     => 'edit'
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        $this -> validate($request, [
            'name'      => 'required',
            'email'      => 'required|email|',
            'mobile'    => 'required',
            'role'        => 'required'
        ]);
        $admin_update = admin::findOrFail($id);
        $admin_update ->update([
            'name'      => $request -> name,
            'mobile'    => $request -> mobile,
            'role_id'   => $request -> role
        ]);
        return back() -> with('success', 'User Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dele_admin = admin::findOrFail($id);
        $dele_admin -> delete();

        return back() -> with('success-main', 'Admin Data delete Successfully');

    }


    /**
     * Status 
     */
    public function StatusUpdate($id)
    {
        $status_update = admin::findOrFail($id);

        if( $status_update -> status ){
            $status_update ->update([
                'status'        => false
            ]);
            // Auth::guard('admin') -> logout();
            return back() -> with('danger-main', 'Admin Data Blocked Successfully');
        }else{
            $status_update ->update([
                'status'        => true
            ]);
            return back() -> with('success-main', 'Admin Data Active Successfully');
        }

    }

    /**
     * Trash Users
     */
    public function TrashUsers()
    {
        $all_admin = admin::latest() -> where('trash', true) -> get();
        return view('pages.user.trash', [
            'all_admin'      => $all_admin,
            'form_type'      => 'trash'
        ]);
    }

    /**
     * Trash Update
     */
    public function TrashUpdate($id)
    {
        $data = admin::findOrFail($id);

        if( $data -> trash ){
            $data -> update([
                'trash'    => false
            ]);
            return back() -> with('success-main', 'Admin Data Restore Successfully');
            
        }else{
            $data -> update([
                'trash'    => true
            ]);
            return back() -> with('danger-main', 'Admin Data Trash Successfully');
        }
    }



}
