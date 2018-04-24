<?php

namespace App\Http\Controllers;

use App\WarehouseItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WarehouseItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $items = DB::table('warehouse_items')
            ->select('group_id', 'price', 'added_at', DB::raw('count(group_id) as quantity, group_id'))
            ->where('warehouse_id', $id)
            ->groupBy('group_id', 'price', 'added_at')
            ->get();

        return $items;

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
        for($i = 0; $i < $request->quantity; $i++){
            WarehouseItem::create($request->warehouse_item);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        WarehouseItem::where('group_id', $id)->delete();

        return ['status' => 1];
    }

    public function getLastGroupId(){

        $last_group_id = WarehouseItem::max('group_id');

        return $last_group_id;
    }
}
