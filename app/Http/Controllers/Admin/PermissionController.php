<?php

namespace App\Http\Controllers\Admin;

use App\Models\permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = permission::latest() ->get();
        return view('pages.user.permission.index', [
            'all_permission'    => $permission,
            'form_type'         => 'create'
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
            'name'      =>'required|unique:permissions'
        ]);

        //  Data Store
        permission::create([
            'name'      =>$request -> name,
            'slug'        =>Str::slug($request -> name)
        ]);

        return back() -> with('success', 'Permission add successfully');

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
        $permission = permission::latest() ->get();
        $per = permission::findOrFail($id);
        return view('pages.user.permission.index', [
            'all_permission'    => $permission,
            'form_type'         => 'edit',
            'edit'                 => $per
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
        $update_data = permission::findOrFail($id);
        $update_data -> update([
            'name'      =>$request -> name,
            'slug'        =>Str::slug($request -> name)
        ]);
        return back() -> with('success', 'Permission Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = permission::findOrFail($id);
        $delete -> delete();
        return back() -> with('info-main', 'Permission Deleted successfully');
    }
}
