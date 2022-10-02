<?php

namespace App\Http\Controllers\Admin;

use App\Models\role;
use App\Models\permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = role::latest() -> get();
        $permissions = permission::latest() -> get();
        return view('pages.user.role.index', [
            'all_role'         => $roles,
            'form_type'     =>'create',
            'permissions'   => $permissions
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
        $this -> validate($request, [
            'name'      =>'required',
            'permissions'   =>'required'
        ]); 

        //  Data Send 
        role::create([
            'name'            => $request -> name,
            'slug'              => Str::slug($request -> name),
            'permissions'    => json_encode( $request -> permissions )

        ]);

        return back() -> with('success', 'Role Data Add successfully');

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
        $roles = role::latest() -> get();
        $edit = role::findOrFail($id);
        $permissions = permission::latest() -> get();
        return view('pages.user.role.index', [
            'all_role'         => $roles,
            'form_type'     =>'edit',
            'permissions'   => $permissions,
            'edit'              => $edit
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
        $update_role = role::findOrFail($id);
        $update_role -> update([
            'name'            => $request -> name,
            'slug'              => Str::slug($request -> name),
            'permissions'    => json_encode( $request -> permissions )
        ]);
        return back() -> with('success', 'Role Data Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role_delete = role::findOrFail($id);
        $role_delete -> delete();

        return back() -> with('info-main', 'Role Data delete successfully');
    }
}
