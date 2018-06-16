<?php

namespace App\Http\Controllers;

use App\AddNewsletter;
use App\Newsletter;
use Illuminate\Http\Request;

class AddNewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AddNewsletterController::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AddNewsletter::create($request->all());


        return ['message' => 'ok'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AddNewsletter  $addNewsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddNewsletter $addNewsletter)
    {
        $addNewsletter->update($request->all());

        return ['status' => 1];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AddNewsletter  $addNewsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddNewsletter $addNewsletter)
    {
        $addNewsletter->delete();

        return ['status' => 1];
    }
}
