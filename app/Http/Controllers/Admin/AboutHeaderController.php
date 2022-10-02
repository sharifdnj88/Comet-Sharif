<?php

namespace App\Http\Controllers\Admin;

use App\Models\A_header;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class AboutHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about_header = A_header::latest() -> get();
        return view('pages.about.header.index',[
            'form_type'      => 'create',
            'about_header'  => $about_header
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
        if( $request ->hasFile('photo') ){
            $img = $request -> file('photo');
            $file_name = md5( time(). rand() ) . '.' . $img -> clientExtension();
            $image = Image::make($img ->getRealPath());
            $image -> save( storage_path('app/public/about_headers/'). $file_name );
        }else{
            $file_name = null;
        }

        A_header::create([
            'header'        => $request -> header,
            'title'            => $request -> title,
            'photo'          => $file_name,
        ]);

        return back() -> with('success', 'Your About Header Added Successfully');

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
        $about_header = A_header::latest() -> get();
        $edit   = A_header::findOrFail($id);
        return view('pages.about.header.index',[
            'form_type'      => 'edit',
            'about_header'  => $about_header,
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
        $a_header_update = A_header::findOrFail($id);

        if( $request ->hasFile('photo') ){
            $img = $request -> file('photo');
            $file_name = md5( time(). rand() ) . '.' . $img -> clientExtension();
            $image = Image::make($img ->getRealPath());
            $image -> save( storage_path('app/public/about_headers/'). $file_name );
        }else{
            $file_name = $request -> old_photo;
        }

        $a_header_update  ->update([
            'header'        => $request -> header,
            'title'            => $request -> title,
            'photo'          => $file_name,
        ]);

        return back() -> with('success', 'Your About Header Update Successfully');

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
