<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact_Counter;
use Illuminate\Http\Request;

class Counter_contact extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $contact_counter = Contact_Counter::latest() -> get();
        return view('pages.contact.counter.index', [
            'form_type'              => 'create',
            'contact_counter'       => $contact_counter
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
        $this ->validate($request, [
           'title'      =>'required', 
           'counter'      =>'required', 
           'icon'      =>'required', 
        ]);
        Contact_Counter::create([
            'title'         => $request -> title,
            'counter'    => $request -> counter,
            'icon'        => $request -> icon,
        ]);
        return back() -> with('success', 'Contact Counter Added Successfully');
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
        $contact_counter = Contact_Counter::latest() -> get();
        $edit   = Contact_Counter::findOrFail($id);
        return view('pages.contact.counter.index', [
            'form_type'              => 'edit',
            'contact_counter'       => $contact_counter,
            'edit'                      => $edit
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
        $update = Contact_Counter::findOrFail($id);
        $update ->update([
            'title'         => $request -> title,
            'counter'    => $request -> counter,
            'icon'        => $request -> icon,
        ]);
        return back() -> with('success', 'Contact Counter Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Contact_Counter::findOrFail($id);
        $delete ->delete();
        return back() -> with('danger', 'Contact Counter Delete Successfully');
    }
}
