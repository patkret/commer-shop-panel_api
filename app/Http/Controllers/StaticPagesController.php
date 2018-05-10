<?php

namespace App\Http\Controllers;

use App\StaticPage;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StaticPage::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return StaticPage::create($request->all());
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
        $data = $request->all();
        StaticPage::find($id)->update($data);
        return ['status' => 1];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StaticPage::find($id)->delete();

        return ['status' => 1];

    }

    public function show($id)
    {
        $page = StaticPage::where('id', $id)->first();

        return $page;
    }


    public function duplicate($id)
    {

        $current_category = StaticPage::where('id', $id)->first();
        $duplicate_category = $current_category->replicate();
        $duplicate_category->name = $duplicate_category->name.'_copy';
        $duplicate_category->save();
    }
}
