<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class VisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vision = Vision::where('trash', false) -> latest() -> get();
        return view('pages.vision.index',[
            'visions'           => $vision,
            'form_type'           => 'create',
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
        // Vision Photo
        if( $request -> hasFile('photo') ){
            $img = $request -> file('photo');
            $file_name = md5( time(). rand() ). '.'. $img -> clientExtension();
            $image = Image::make($img ->getRealPath());
            $image -> save( storage_path('app/public/visions/'). $file_name );
        }else{
            $file_name = null;
        }

        // Vision Button Management
        $buttons = [];

        if( isset( $request -> vision_name ) ){
            for( $i = 0; $i < count( $request -> vision_name ); $i++ ){
                array_push( $buttons, [
                    'vision_name'       => $request -> vision_name[$i],
                    'vision_desc'       => $request -> vision_desc[$i],
                ] );
            }
        }

        Vision::create([
            'title'                => $request -> title,
            'heading'          => $request -> heading,
            'photo'             => $file_name,
            'btns'               => json_encode( $buttons ),
        ]);
        return back() -> with('success', 'Your Vision Added Successfully');

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
        $vision = Vision::latest() -> get();
        $edit = Vision::findOrFail($id);
        return view('pages.vision.index',[
            'visions'           => $vision,
            'form_type'       => 'edit',
            'edit'               => $edit
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
        $vision_update = Vision::findOrFail($id);

        // Vision Photo
        if( $request -> hasFile('photo') ){
            $img = $request -> file('photo');
            $file_name = md5( time(). rand() ). '.'. $img -> clientExtension();
            $image = Image::make($img ->getRealPath());
            $image -> save( storage_path('app/public/visions/'). $file_name );
        }else{
            $file_name = $request -> old_photo;
        }

        // Vision Button Management
        $buttons = [];

        if( isset( $request -> vision_name ) ){
            for( $i = 0; $i < count( $request -> vision_name ); $i++ ){
                array_push( $buttons, [
                    'vision_name'       => $request -> vision_name[$i],
                    'vision_desc'       => $request -> vision_desc[$i],
                ] );
            }
        }

        $vision_update ->update([
            'title'             => $request -> title,
            'heading'         => $request -> heading,
            'photo'           => $file_name,
            'btns'             => json_encode( $buttons )
        ]);

        return back() -> with('success', 'Your Vision Update Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vision_delete = Vision::findOrFail($id);
        $vision_delete -> delete();

        return back() -> with('danger-main', 'This Vision Data delete Successfully');
    }

    // Vision Status
    public function SliderStatus($id)
    {
        $vision_status = Vision::findOrFail($id);

        if( $vision_status -> status ){
            $vision_status -> update([
                'status'        => false
            ]);
            return back() -> with('danger-main', 'This Vision Unpublished Successfully');
        }else{
            $vision_status -> update([
                'status'        => true
            ]);
            return back() -> with('success-main', 'This Vision Published Successfully');
        }
    }

    // Vision Trash
    public function VisionTrash()
    {
        $all_vision = Vision::latest() -> where('trash', true) -> get();
        return view('pages.vision.trash',[
            'all_slider'            => $all_vision,
            'form_type'           => 'trash'
        ]);
    }

    // Vision Trash Update
    public function VisionUpdate($id)
    {
        $vision_update = Vision::findOrFail($id);

        if( $vision_update -> trash ){
            $vision_update ->update([
                'trash'         => false
            ]);
            return back() -> with('success-main', 'This Vision Restore Successfully');
        }else{
            $vision_update -> update([
                'trash'         => true
            ]);
            return back() -> with('danger-main', 'This Vision Trash Successfully');
        }
    }

}
