<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest() -> get();
        return view('pages.category.index',[
            'categories'           => $categories,
            'form_type'           => 'create'
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
            'name'      =>'required|unique:categories'
        ]);
        // Store
        Category::create([
            'name'      => $request -> name,
            'slug'        => Str::slug($request -> name)
        ]);

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
        $categories = Category::latest() -> get();
        $edit   = Category::findOrFail($id);
        return view('pages.category.index',[
            'form_type'      => 'edit',
            'categories'  => $categories,
            'edit'          => $edit
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
        $update = Category::findOrFail($id);
        $update ->update([
            'name'        => $request -> name,
            'slug'          => Str::slug($request -> name)
        ]);
        return back() -> with('success', 'Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Category::findOrFail($id);
        $delete -> delete();
        return back() -> with('danger', 'Category Delete Successfully');
    }
}
