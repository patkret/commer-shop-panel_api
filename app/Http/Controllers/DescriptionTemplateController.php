<?php

namespace App\Http\Controllers;

use App\DescriptionTemplate;
use Illuminate\Http\Request;

class DescriptionTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = DescriptionTemplate::all();

        return $templates;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = DescriptionTemplate::create($request->description_template);

        return $template;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DescriptionTemplate  $descriptionTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DescriptionTemplate $descriptionTemplate)
    {
        $descriptionTemplate->update($request->description_template);

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DescriptionTemplate  $descriptionTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(DescriptionTemplate $descriptionTemplate)
    {
        $descriptionTemplate->delete();

        return response()->json();
    }

    public function getTemplate($id)
    {
        $template = DescriptionTemplate::where('id', $id)->first();

        return $template;
    }
}
