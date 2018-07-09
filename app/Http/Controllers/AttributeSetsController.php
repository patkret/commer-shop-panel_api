<?php

namespace App\Http\Controllers;

use App\AttributeSet;
use Illuminate\Http\Request;
use App\Log;

class AttributeSetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributeSets = AttributeSet::all();

        return $attributeSets;


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  AttributeSet $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AttributeSet $attributeSet)
    {

        $attr_set = $attributeSet->create($request->all());

        $attr_set->categories()->sync($request->defaultCategoriesIds);

        Log::createNew($attributeSet->module_id, $attr_set->name , 'add');

        return $attr_set;

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

        $attributeSet = new AttributeSet();
        Log::createNew($attributeSet->module_id, $attr_set->name , 'edit');

        return response()->json('updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeSet = new AttributeSet();
        $attr_set = $attributeSet->where('id', $id)->first();
        AttributeSet::find($id)->delete();

        Log::createNew($attributeSet->module_id, $attr_set->name , 'delete');
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
