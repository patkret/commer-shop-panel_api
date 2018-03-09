<?php

namespace App\Http\Controllers;

use App\AttributeSet;
use App\Attribute;
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
        return AttributeSet::with('attributes')->paginate(10);

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

        $attr_set->attributes()->sync($request->selectedAttributes);

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

        $attr_set->attributes()->sync($request->selectedAttributes);

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

//    public function attributesList($id){
//
//        $list = AttributeSet::find($id)->attributes->pluck('name', 'id')->toArray();
//
//        $attr_ids = [];
//
//        foreach($list as $key => $value){
//
//            $attr_ids[] = $key;
//        }
//
//        $set_has_attributes= Attribute::whereIn('id', $attr_ids)->get()->toArray();
//
//        return $set_has_attributes;
//    }

    public function getAttributeSet($id){

        $attr_set = AttributeSet::with(['attributes', 'category'])->where('id', $id)->first();

        return $attr_set;
    }

}
