<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\Categorypost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest() -> get();
        $cats = Categorypost::latest() -> get();
        $tags = Tag::latest() -> get();
        return view('pages.post.index',[
            'posts'                 => $posts,
            'form_type'           => 'create',
            'cats'                   => $cats,
            'tags'                   => $tags
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
            'title'         =>'required|unique:posts',
            'content'     =>'required'
        ]);

        // Upload Standard Post
         if( $request ->hasFile('standard') ){
            $img = $request -> file('standard');
            $standard = md5( time(). rand() ) . '.' . $img -> clientExtension();
            $image = Image::make($img ->getRealPath());
            $image -> save( storage_path('app/public/posts/'). $standard );
        }else{
            $standard = null;
        }

        // Upload Gallery Post
        $gallery_files = [];
        if( $request ->hasFile('gallery') ){
            $gallery = $request -> file('gallery');

            foreach( $gallery as $gall ){
                $gall_name = md5( time(). rand() ) . '.' . $gall -> clientExtension();
                $image = Image::make($gall ->getRealPath());
                $image -> save( storage_path('app/public/posts/'). $gall_name );
                array_push($gallery_files, $gall_name);

            }

        }

        // Post Management
        $post_type = [
            'post_type'     => $request -> type,
            'standard'      => $standard,
            'video'             => $this -> embed($request -> video),
            'audio'          => $request -> audio,
            'gallery'         => json_encode($gallery_files),
            // 'standard'      => $standard ?? null,
        ];


        // Store
        $post = Post::create([
            'admin_id'       => Auth::guard('admin') -> User() -> id,
            'title'              => $request -> title,
            'slug'              =>  $this -> slugMaker($request -> title),
            'content'          => $request -> content,
            'featured'          => json_encode($post_type),
        ]);

        $post -> categorypost() -> attach($request -> cat);
        $post -> tag() -> attach($request -> tag);

        // Message
        return back() -> with('success', 'Category Added Successfully');
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
