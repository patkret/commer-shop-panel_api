<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingDetailRequest;
use App\ShippingDetail;
use Illuminate\Http\Request;

class ShippingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping_detail = ShippingDetail::all();

        return $shipping_detail;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingDetailRequest $request)
    {
        $created = ShippingDetail::create($request->all());

        return $created;

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ShippingDetail $shippingDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingDetail $shippingDetail)
    {
        $shippingDetail->update($request->all());

        return response()->json[('updated')];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShippingDetail $shippingDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingDetail $shippingDetail)
    {
        $shippingDetail->delete();

        return response()->json('deleted');
    }

    public function getClientShippingDetails($client_id)
    {

        $shipping_details = ShippingDetail::where('client_id', $client_id)->get();

        return $shipping_details;
    }
}
