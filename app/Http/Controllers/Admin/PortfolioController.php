<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::latest() -> get();
        $categories = Category::latest() -> get();
        return view('pages.portfolio.index',[
            'form_type'        => 'create',
            'portfolios'         => $portfolios,
            'categories'        => $categories
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
            'title'         => 'required',
            'photo'       => 'required',
            'cat'           => 'required'  
        ]);

        // Image Management
        if( $request ->hasFile('photo') ){
            $img = $request -> file('photo');
            $file_name = md5( time(). rand() ) . '.' . $img -> clientExtension();
            $image = Image::make($img ->getRealPath());
            $image -> save( storage_path('app/public/portfolio/'). $file_name );
        }else{
            $file_name = null;
        }

        // Gallery Management
        $gallery_files = [];
        if( $request ->hasFile('gallery') ){
            $gallery = $request -> file('gallery');

            foreach( $gallery as $gall ){
                $gall_name = md5( time(). rand() ) . '.' . $gall -> clientExtension();
                $image = Image::make($gall ->getRealPath());
                $image -> save( storage_path('app/public/portfolio/'). $gall_name );
                array_push($gallery_files, $gall_name);

            }

        }

        // Steps Management
        $steps = [];
        if( count( $request -> stitle ) > 0 ){
            for( $i = 0; $i < count( $request -> stitle ); $i++ ){
                array_push($steps, [
                    'stitle'           => $request -> stitle[$i],
                    'sdesc'          => $request -> sdesc[$i],
                ]);
            }

        }
        
        // Store
        $portfolio = Portfolio::create([
            'title'             => $request -> title,
            'slug'             => Str::slug($request -> title),
            'featured'       => $file_name,
            'gallery'         => json_encode($gallery_files),
            'desc'            => $request -> desc,
            'steps'           => json_encode($steps),
            'client'           => $request -> client,
            'link'             => $request -> link,
            'types'           => $request -> types,
            'date'            => $request -> date,
        ]);

        $portfolio -> category() ->  attach($request -> cat);

        // Return Back
        return back() -> with('success', 'Your Portfolio Added Successfully');
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
