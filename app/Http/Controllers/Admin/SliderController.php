<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_slider = Slider::latest()-> where('trash', false) -> get();
        return view('pages.slider.index',[
            'form_type'     => 'create',
            'all_slider'       => $all_slider
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
        // Patient Photo Upload
        if( $request -> hasFile('photo') ){

            $img = $request -> file('photo');
            $file_name = md5( time(). rand() ) . '.' . $img -> clientExtension();
            // $img -> move( storage_path('app/public/sliders/'), $file_name );
            $image = Image::make($img ->getRealPath());
            $image -> save( storage_path('app/public/sliders/'). $file_name );

        }else{
            $file_name = null;
        }

         // BTN Management
         $buttons = [];

         if( isset( $request -> btn_title ) ){

            for( $i = 0; $i < count( $request -> btn_title); $i++ ){
                array_push($buttons, [
                    'btn_title' =>  $request -> btn_title[$i],
                    'btn_link'  =>  $request -> btn_link[$i],
                    'btn_type' => $request -> btn_type[$i]
                ]);
            }

         }

         

        Slider::create([
            'title'         => $request -> title,
            'subtitle'     => $request -> subtitle,
            'photo'       => $file_name,
            'btns'         => json_encode($buttons)
        ]);       

        return back() -> with('success', 'Your Slider Added Successfully');

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
        $all_slider = Slider::latest() -> get();
        $edit = Slider::findOrFail($id);

        return view('pages.slider.index', [
            'all_slider'        => $all_slider,
            'edit'          =>  $edit,
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
        $slider_update = Slider::findOrFail($id);

        if( $request -> hasFile('photo') ){

            $img = $request -> file('photo');
            $file_name = md5( time(). rand() ) . '.' . $img -> clientExtension();
            $image = Image::make($img ->getRealPath());
            $image -> save( storage_path('app/public/sliders/'). $file_name );

        }else{
            $file_name = $request -> old_photo;
        }

        // BTN Manafement
        $buttons = [];

        if( isset( $request -> btn_title ) ){

            for( $i = 0; $i < count( $request -> btn_title); $i++ ){
                array_push($buttons, [
                    'btn_title' =>  $request -> btn_title[$i],
                    'btn_link'  =>  $request -> btn_link[$i],
                    'btn_type' => $request -> btn_type[$i]
                ]);
            }

         }


        $slider_update ->update([
            'title'             => $request -> title,
            'subtitle'         => $request -> subtitle,
            'photo'           => $file_name,
            'btns'             => json_encode( $buttons )
        ]);

        return back() -> with('success', 'Your Slider Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider_delete = Slider::findOrFail($id);
        $slider_delete -> delete();

        return back() -> with('danger-main', 'This Slider delete Successfully');
    }

    //  Slider Status
    public function SliderStatus($id)
    {
        $slider_status = Slider::findOrFail($id);

        if( $slider_status -> status ){
            $slider_status -> update([
                'status'        => false
            ]);
            return back() -> with('danger-main', 'This Slider Blocked Successfully');
        }else{
            $slider_status -> update([
                'status'        => true
            ]);
            return back() -> with('success-main', 'This Slider Active Successfully');
        }

    }

    // Slider Trash
    public function SliderTrash()
    {
        $all_slider = Slider::latest() -> where('trash', true) -> get();
        return view('pages.slider.trash',[
            'all_slider'            => $all_slider,
            'form_type'           => 'trash'
        ]);
    }

    //  Slider Trash Update
    public function SliderUpdate($id)
    {
        $slider_update = Slider::findOrFail($id);

        if( $slider_update -> trash ){
            $slider_update ->update([
                'trash'         => false
            ]);
            return back() -> with('success-main', 'This Slider Restore Successfully');
        }else{
            $slider_update -> update([
                'trash'         => true
            ]);
            return back() -> with('danger-main', 'This Slider Trash Successfully');
        }


    }


}
