<?php

namespace App\Http\Controllers;

use App\Log;
use App\VatRate;
use Illuminate\Http\Request;

class VatRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vatRates = VatRate::all();

        return $vatRates;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created = VatRate::create($request->all());
        $vatRate = new VatRate();
        Log::createNew($vatRate->module_id, $created->name, 'add');

        return $created;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  VatRate $vatRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VatRate $vatRate)
    {
        $vatRate->update($request->vat_rate);
        $name = $vatRate->name;

        Log::createNew($vatRate->module_id, $name, 'edit');

        return response()->json('updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  VatRate $vatRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(VatRate $vatRate)
    {
        $name = $vatRate->name;
        $vatRate->delete();

        Log::createNew($vatRate->module_id, $name, 'delete');

        return response()->json('deleted');
    }


    public function getRate($id)
    {

        $rate = VatRate::where('id', $id)->first();

        return $rate;

    }
}
