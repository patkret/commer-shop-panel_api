<?php

namespace App\Http\Controllers;

use App\VariantGroup;
use Illuminate\Http\Request;
use App\Log;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created = VariantGroup::create($request->all());

        $varGroup = new VariantGroup();

        Log::createNew($varGroup->module_id, $created->name, 'add');

        return $created;
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

        VariantGroup::find($variantGroup)->first()->update($request->all());

        Log::createNew($variantGroup->module_id, $variantGroup->name, 'edit');

        return ['status' => 1];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VariantGroup  $variantGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(VariantGroup $variantGroup)
    {

        VariantGroup::find($variantGroup)->first()->delete();

        Log::createNew($variantGroup->module_id, $variantGroup->name, 'delete');

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

    public function getVariantGroup($id){

       $variantGroup =  VariantGroup::where('id', $id)->first();

       return $variantGroup;
    }
}
