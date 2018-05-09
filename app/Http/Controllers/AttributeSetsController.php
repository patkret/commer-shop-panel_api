<?php

namespace App\Http\Controllers;

use App\AttributeSet;
use Illuminate\Http\Request;

class AttributeSetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributeSet = AttributeSet::all();

        return $attributeSet;
        return ['status' => 1];

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
    public function store(Request $request, AttributeSet $test)
    {

        $attr_set = $test->create($request->all());

        $attr_set->categories()->sync($request->defaultCategoriesIds);

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
        $attr_set = AttributeSet::find($id);

        $attr_set->update($request->all());

        $attr_set->categories()->sync($request->defaultCategoriesIds);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AttributeSet::find($id)->delete();
    }


    public function getAttributeSet($id){

        $attr_set = AttributeSet::with(['categories'])->where('id', $id)->first();

        return $attr_set;
    }

    public function getAttributeSetCategories($id){

        $category_attribute_sets = AttributeSet::find($id)->first()->categories;

        return $category_attribute_sets;
    }


}
