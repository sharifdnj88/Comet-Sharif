<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest() -> get();
        return view('pages.client.index',[
            'clients'           => $clients,
            'form_type'       => 'create'
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
        $this -> validate($request, [
            'name'         => 'required',
            'logo'           => 'required|unique:Clients',
        ]);

        // Clent Logo Upload
        if( $request -> hasFile('logo') ){

            $img = $request -> file('logo');
            $file_name = md5( time(). rand() ) . '.' . $img -> clientExtension();
            $image = Image::make($img ->getRealPath());
            $image -> save( storage_path('app/public/clients/'). $file_name );

        }else{
            $file_name = null;
        }

        // Client Store
        Client::create([
            'name'      => $request -> name,
            'logo'        => $file_name
        ]);

        return back() -> with('success', 'Client Data Added Successfully');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
