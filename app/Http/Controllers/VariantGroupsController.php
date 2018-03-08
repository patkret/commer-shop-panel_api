<?php

namespace App\Http\Controllers;

use App\VariantGroup;
use Illuminate\Http\Request;

class VariantGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variant_groups = VariantGroup::all();

        return $variant_groups;
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
        VariantGroup::create($request->all());

        return ['status' => 1];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VariantGroup  $variantGroup
     * @return \Illuminate\Http\Response
     */
    public function show(VariantGroup $variantGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VariantGroup  $variantGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(VariantGroup $variantGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VariantGroup  $variantGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VariantGroup $variantGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VariantGroup  $variantGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(VariantGroup $variantGroup)
    {

        if (VariantGroup::find($variantGroup)->first()->delete()){
            return ['status' => 1];
        }
        else
            return ['status' => 0];
    }

    public function variantTypes(){

        $variantTypes = [
            ['id'=> 0, 'name' =>'pole tekstowe'],
            ['id'=> 1, 'name' =>'checkbox'],
            ['id'=> 2, 'name' =>'select'],
            ['id'=> 3, 'name' =>'plik'],
        ];

        return $variantTypes;
    }

    public function priceOptions(){

        $priceOptions = [
            ['id' => 0, 'name' => 'nie zmieniaj'],
            ['id' => 1, 'name' => 'zwiększ o'],
            ['id' => 2, 'name' => 'zmniejsz o'],
        ];

        return $priceOptions;
    }
}
