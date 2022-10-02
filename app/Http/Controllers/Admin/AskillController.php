<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\A_skill;
use Illuminate\Http\Request;

class AskillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about_skill = A_skill::latest() -> get();
        return view('pages.about.skill.index',[
            'form_type'      => 'create',
            'about_skill'  => $about_skill
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
        A_skill::create([
            'name'        => $request -> name,
            'progress'    => $request -> progress,
        ]);

        return back() -> with('success', 'Your About Skill Added Successfully');
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
        $about_skill = A_skill::latest() -> get();
        $edit   = A_skill::findOrFail($id);
        return view('pages.about.skill.index',[
            'form_type'      => 'edit',
            'about_skill'  => $about_skill,
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
        $update = A_skill::findOrFail($id);
        $update ->update([
            'name'        => $request -> name,
            'progress'    => $request -> progress,
        ]);
        return back() -> with('success', 'Your About Skill Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = A_skill::findOrFail($id);
        $delete -> delete();
        return back() -> with('danger', 'Your About Skill Delete Successfully');
    }
}
